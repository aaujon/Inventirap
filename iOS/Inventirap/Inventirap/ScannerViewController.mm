//
//  ViewController.m
//  Inventirap
//
//  Created by Thomas Zilio on 1/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import "ScannerViewController.h"

#import "QRCodeReader.h"
#import "InformationViewController.h"
#import "Settings.h"
#import "Product.h"

@interface ScannerViewController ()

@end

@implementation ScannerViewController

@synthesize applicationActivity;
@synthesize scanResults;
@synthesize scanButton;
@synthesize informationLabel;

#pragma mark -
#pragma mark Initialization

- (id) initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    
    if (self) {
        if ([[UIDevice currentDevice] userInterfaceIdiom] == UIUserInterfaceIdiomPhone) {
            m_informationViewController = [[InformationViewController alloc] initWithNibName:@"InformationViewController_iPhone" bundle:nil];
        } else {
            m_informationViewController = [[InformationViewController alloc] initWithNibName:@"InformationViewController_iPad" bundle:nil];
        }
        self.title = NSLocalizedString(@"Scanner", @"Scanner");
        self.tabBarItem.image = [UIImage imageNamed:@"first"];
    }
    
    return self;
}

#pragma mark -
#pragma mark View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    [applicationActivity setHidesWhenStopped:YES];
    [informationLabel setHidden:YES];
}

- (void)viewDidUnload
{
    applicationActivity = nil;
    [self setApplicationActivity:nil];
    [self setScanButton:nil];
    [self setInformationLabel:nil];
    [super viewDidUnload];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    if ([[UIDevice currentDevice] userInterfaceIdiom] == UIUserInterfaceIdiomPhone) {
        return (interfaceOrientation != UIInterfaceOrientationPortraitUpsideDown);
    } else {
        return NO;
    }
}

#pragma mark -
#pragma mark Scan and more

- (void)launchQRCodeReader
{
    [informationLabel setHidden:YES];
    
	// Opening the QRCode reader window
    ZXingWidgetController *widController = [[ZXingWidgetController alloc] initWithDelegate:self
																				showCancel:YES
																				  OneDMode:NO];
	QRCodeReader* qrcodeReader = [[QRCodeReader alloc] init];
	NSSet *readers = [[NSSet alloc ] initWithObjects:qrcodeReader,nil];
	
	widController.readers = readers;
	[self presentModalViewController:widController animated:NO];
}

- (IBAction)scanButtonAction:(id)sender
{
    [self launchQRCodeReader];
}

- (void) processResults
{
#warning Enable QRCode result check
    if (YES) { //[scanResults hasPrefix:@"IRAP-"])
        [applicationActivity startAnimating];
        [scanButton setEnabled:false];
        
        [informationLabel setTextColor: [UIColor blackColor]];
        [informationLabel setText:@"Contacting WebService ..."];
        
        [self sendWebServiceRequest:scanResults];
    } else {
        [informationLabel setTextColor: [UIColor redColor]];
        [informationLabel setText:@"Invalid QRCode"];
    }
    [informationLabel setHidden:NO];
    
}

#pragma mark -
#pragma mark ZXing delegate methods

- (void)zxingController:(ZXingWidgetController*)controller didScanResult:(NSString *)result
{
    [self dismissModalViewControllerAnimated:NO];
	self.scanResults = result;
    
    [self processResults];
}

- (void)zxingControllerDidCancel:(ZXingWidgetController*)controller
{
    [self dismissModalViewControllerAnimated:NO];
}

#pragma mark -
#pragma mark Scan processing

- (void) sendWebServiceRequest:(NSString*)ident
{
    NSString *completeURL = [NSString stringWithFormat:@"%@%@",[[Settings sharedSettings] webServiceUrl], ident];

#warning Change URL
    completeURL = @"http://api.kivaws.org/v1/loans/search.json?status=fundraising";
    NSURLRequest *request = [NSURLRequest requestWithURL:[NSURL URLWithString:completeURL]];
    
    m_connection = [[NSURLConnection alloc] initWithRequest:request delegate:self];
    if (m_connection) {
        m_jsonData = [NSMutableData data];
    } else {
        [informationLabel setTextColor: [UIColor redColor]];
        [informationLabel setText:@"Error while connecting to the WebService"];
        [applicationActivity stopAnimating];
        [scanButton setEnabled:true];
    }
    
}

- (void) parseDictionary:(NSDictionary*)dictionary ForProduct:(Product*)product
{
    for(id key in dictionary) {
        id value = [dictionary objectForKey:key];
        if ([value isKindOfClass:[NSNull class]]) {
            value = @"";
        } else {
            if ([value isKindOfClass:[NSNumber class]]) {
                if ([value boolValue])
                    value = @"oui";
                else {
                    value = @"non";
                }
            }
        }
        
        NSString *keyAsString = (NSString *)key;
        NSString *valueAsString = (NSString *)value;
        
        if ([keyAsString isEqualToString:@"designation"]) {
            [product setName:valueAsString];
        }
        
        [product addPropertyName:keyAsString AndValue:valueAsString];
    }
}

#pragma mark -
#pragma mark Connection delegate methods

- (void) connection:(NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response
{
    [m_jsonData setLength:0];
}

-(void) connection:(NSURLConnection *)connection didReceiveData:(NSData *)data
{
    [m_jsonData appendData:data];
}

- (void) connection:(NSURLConnection *)connection didFailWithError:(NSError *)error
{
    [informationLabel setTextColor: [UIColor redColor]];
    [informationLabel setText:@"Error while connecting to the WebService"];
    [applicationActivity stopAnimating];
    [scanButton setEnabled:true];
}

- (void) connectionDidFinishLoading:(NSURLConnection *)connection
{
#warning Replace with real json data
    NSString *blabla = @"{\"materials\":[{\"Materiel\":{\"id\":\"1\",\"designation\":\"Macbook air\",\"category_id\":\"1\",\"sous_category_id\":\"2\",\"numero_irap\":\"IRAP-12-0001\",\"description\":\"Ceci est une description un peu nulle\",\"organisme\":\"IRAP\",\"materiel_administratif\":true,\"materiel_technique\":false,\"status\":\"CREATED\",\"date_acquisition\":\"2012-07-04\",\"fournisseur\":\"Apple\",\"prix_ht\":\"1000\",\"eotp\":\"WTF\",\"numero_commande\":\"ZERZE45\",\"code_comptable\":\"44\",\"numero_serie\":null,\"thematic_group_id\":\"1\",\"work_group_id\":\"1\",\"ref_existante\":null,\"lieu_stockage\":\"B\",\"lieu_detail\":\"Chambre\",\"utilisateur_id\":\"1\",\"full_storage\":\"B-Chambre\"},\"Category\":{\"id\":\"1\",\"nom\":\"Multimetre\"},\"SousCategory\":{\"id\":\"2\",\"nom\":\"RUI + LC\",\"category_id\":\"1\"},\"ThematicGroup\":{\"id\":\"1\",\"nom\":\"GPPS\"},\"WorkGroup\":{\"id\":\"1\",\"nom\":\"NVA\"},\"Suivi\":[{\"id\":\"1\",\"materiel_id\":\"1\",\"date_controle\":\"2012-03-03\",\"date_prochain_controle\":\"2012-03-03\",\"type_intervention\":\"Maintenance\",\"organisme\":\"IRAP\",\"frequence\":\"3\",\"commentaire\":\"Super cooolos\"},{\"id\":\"2\",\"materiel_id\":\"1\",\"date_controle\":\"2012-03-03\",\"date_prochain_controle\":\"2012-03-03\",\"type_intervention\":\"Calibration\",\"organisme\":\"IRAP\",\"frequence\":\"1\",\"commentaire\":\"Ca sert pas \u00e0 grand chose\"},{\"id\":\"3\",\"materiel_id\":\"1\",\"date_controle\":\"2012-03-03\",\"date_prochain_controle\":\"2012-03-03\",\"type_intervention\":\"Maintenance\",\"organisme\":\"IRAP\",\"frequence\":\"10\",\"commentaire\":\"Pas souvent lui la maintenance\"}],\"Emprunt\":[{\"id\":\"1\",\"materiel_id\":\"1\",\"date_emprunt\":\"2011-01-01\",\"date_retour_emprunt\":\"2013-01-01\",\"piece\":\"Souris\",\"emprunt_interne\":false,\"laboratoire\":\"IRAP\",\"responsable\":\"Dark Vador\"},{\"id\":\"2\",\"materiel_id\":\"1\",\"date_emprunt\":\"2010-04-05\",\"date_retour_emprunt\":\"2010-12-12\",\"piece\":\"Clavier\",\"emprunt_interne\":false,\"laboratoire\":\"IRAP\",\"responsable\":\"Woody Allen\"}]}],\"id\":\"IRAP-12-0001\"}";
    
    NSData *jsonData = [blabla dataUsingEncoding:NSUTF8StringEncoding];
    
    
    NSError *error = nil;
    NSDictionary *res = [NSJSONSerialization JSONObjectWithData:jsonData options:kNilOptions error:&error];
    
    [informationLabel setText:@"Parsing results ..."];
    
    Product *product = [[Product alloc] init];
    
    NSArray *results = [res objectForKey:@"materials"];
    NSDictionary* result = [results objectAtIndex:0];
    
    // Parsing Materiel
    NSDictionary* materiel = [result objectForKey:@"Materiel"];
    [self parseDictionary:materiel ForProduct:product];    
    [product setSectionWithName:@"Matériel"];
    
    // Parsing Category
    NSDictionary* category = [result objectForKey:@"Category"];
    [self parseDictionary:category ForProduct:product];    
    [product setSectionWithName:@"Catégorie"];
    
    // Parsing SousCategory
    NSDictionary* subcategory = [result objectForKey:@"SousCategory"];
    [self parseDictionary:subcategory ForProduct:product];    
    [product setSectionWithName:@"Sous-Catégories"];
    
    [applicationActivity stopAnimating];
    [informationLabel setHidden:YES];
    [scanButton setEnabled:true];
    
    [m_informationViewController initData:product];
    [self.navigationController pushViewController:m_informationViewController animated:TRUE];
    
}
@end
