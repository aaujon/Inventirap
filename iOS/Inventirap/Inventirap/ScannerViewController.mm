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

@property (nonatomic, retain) InformationViewController *informationViewController;
@property (nonatomic, retain) NSMutableData *jsonData;
@property (nonatomic, retain) NSURLConnection *connection;

@property (nonatomic, copy) NSString *scanResults;

- (void) launchQRCodeReader;
- (void) processResults;
- (void) sendWebServiceRequest:(NSString*)ident;
- (void) parseDictionary:(NSDictionary*)dictionary ForProduct:(Product*)product;

@end

@implementation ScannerViewController
@synthesize lastProductButton;

@synthesize informationViewController;
@synthesize scanResults, jsonData, connection;
@synthesize applicationActivity, scanButton, informationLabel;

#pragma mark -
#pragma mark Initialization

- (id) initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    
    if (self) {
        if ([[UIDevice currentDevice] userInterfaceIdiom] == UIUserInterfaceIdiomPhone) {
            [self setInformationViewController:[[InformationViewController alloc] initWithNibName:@"InformationViewController_iPhone" bundle:nil]];
        } else {
            [self setInformationViewController:[[InformationViewController alloc] initWithNibName:@"InformationViewController_iPad" bundle:nil]];
        }
        [self setTitle:NSLocalizedString(@"SCANNER", nil)];
        self.tabBarItem.image = [UIImage imageNamed:@"scannerTabBarIcon"];
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

- (void) viewWillAppear:(BOOL)animated
{
    if ([[self informationViewController] selectedProduct] == nil) {
        [[self lastProductButton] setHidden:YES];
    } else {
        [[self lastProductButton] setHidden:NO];
    }
}

- (void)viewDidUnload
{
    [self setApplicationActivity:nil];
    [self setScanButton:nil];
    [self setInformationLabel:nil];
    [self setLastProductButton:nil];
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
    [[self lastProductButton] setHidden:YES];
#warning Restore correct code
    [self processResults];
    //[self launchQRCodeReader];
}

- (IBAction)lastProductButtonAction:(id)sender {
    [self.navigationController pushViewController:[self informationViewController] animated:TRUE];
}

- (void) processResults
{
#warning Enable QRCode result check
    if (YES) { //[[self scanResults] hasPrefix:@"IRAP-"])
        [applicationActivity startAnimating];
        [scanButton setEnabled:false];
        
        [informationLabel setTextColor: [UIColor blackColor]];
        [informationLabel setText:NSLocalizedString(@"CONTACTWEBSERV", nil)];
        
        [self sendWebServiceRequest:[self scanResults]];
    } else {
        [informationLabel setTextColor: [UIColor redColor]];
        [informationLabel setText:NSLocalizedString(@"INVALIDEQRCODE", nil)];
    }
    [informationLabel setHidden:NO];
    
}

#pragma mark -
#pragma mark ZXing delegate methods

- (void)zxingController:(ZXingWidgetController*)controller didScanResult:(NSString *)result
{
    [self dismissModalViewControllerAnimated:NO];
    [self setScanResults:result];
    
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
    completeURL = @"http://inventirap.dyndns.org:8080/Inventirap/cakephp/ServicesWeb/materiel/IRAP-12-0002";
    completeURL = @"http://api.kivaws.org/v1/loans/search.json?status=fundraising";
    NSURLRequest *request = [NSURLRequest requestWithURL:[NSURL URLWithString:completeURL] cachePolicy:NSURLRequestReloadIgnoringCacheData timeoutInterval:15];
    
    [self setConnection:[[NSURLConnection alloc] initWithRequest:request delegate:self]];
    if ([self connection]) {
        [self setJsonData:[NSMutableData data]];
    } else {
        [informationLabel setTextColor: [UIColor redColor]];
        [informationLabel setText:NSLocalizedString(@"ERRORCONNECTWEBSERV", nil)];
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
                    value = NSLocalizedString(@"YES", nil);
                else {
                    value = NSLocalizedString(@"NO", nil);
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
    [[self jsonData] setLength:0];
}

-(void) connection:(NSURLConnection *)connection didReceiveData:(NSData *)data
{
    [[self jsonData] appendData:data];
}

- (void) connection:(NSURLConnection *)connection didFailWithError:(NSError *)error
{
    [informationLabel setTextColor: [UIColor redColor]];
    [informationLabel setText:NSLocalizedString(@"ERRORCONNECTWEBSERV", nil)];
    [applicationActivity stopAnimating];
    [scanButton setEnabled:true];
}

- (void) connectionDidFinishLoading:(NSURLConnection *)connection
{
#warning Replace with real json data
    NSString *blabla = @"{\"materials\":[{\"Materiel\":{\"id\":\"1\",\"designation\":\"Macbook air\",\"category_id\":\"1\",\"sous_category_id\":\"2\",\"numero_irap\":\"IRAP-12-0001\",\"description\":\"Ceci est une description un peu nulle\",\"organisme\":\"IRAP\",\"materiel_administratif\":false,\"nom_responsable\":\"Cedric\",\"email_responsable\":\"Cedric.Hillembrand@irap.omp.eu\",\"materiel_technique\":false,\"status\":\"CREATED\",\"date_acquisition\":\"2012-07-04\",\"fournisseur\":\"Apple\",\"prix_ht\":\"1000\",\"eotp\":\"WTF\",\"numero_commande\":\"ZERZE45\",\"code_comptable\":\"44\",\"numero_serie\":null,\"thematic_group_id\":\"1\",\"work_group_id\":\"1\",\"ref_existante\":null,\"lieu_stockage\":\"B\",\"lieu_detail\":\"Chambre\",\"utilisateur_id\":\"1\",\"full_storage\":\"B-Chambre\"},\"Category\":{\"id\":\"1\",\"nom\":\"Multimetre\"},\"SousCategory\":{\"id\":\"2\",\"nom\":\"RUI + LC\",\"category_id\":\"1\"},\"ThematicGroup\":{\"id\":\"1\",\"nom\":\"GPPS\"},\"WorkGroup\":{\"id\":\"1\",\"nom\":\"NVA\"},\"Suivi\":[{\"id\":\"1\",\"materiel_id\":\"1\",\"date_controle\":\"2012-03-03\",\"date_prochain_controle\":\"2012-03-03\",\"type_intervention\":\"Maintenance\",\"organisme\":\"IRAP\",\"frequence\":\"3\",\"commentaire\":\"Super cooolos\"},{\"id\":\"2\",\"materiel_id\":\"1\",\"date_controle\":\"2012-03-03\",\"date_prochain_controle\":\"2012-03-03\",\"type_intervention\":\"Calibration\",\"organisme\":\"IRAP\",\"frequence\":\"1\",\"commentaire\":\"Ca sert pas \u00e0 grand chose\"},{\"id\":\"3\",\"materiel_id\":\"1\",\"date_controle\":\"2012-03-03\",\"date_prochain_controle\":\"2012-03-03\",\"type_intervention\":\"Maintenance\",\"organisme\":\"IRAP\",\"frequence\":\"10\",\"commentaire\":\"Pas souvent lui la maintenance\"}],\"Emprunt\":[{\"id\":\"1\",\"materiel_id\":\"1\",\"date_emprunt\":\"2011-01-01\",\"date_retour_emprunt\":\"2013-01-01\",\"piece\":\"Souris\",\"emprunt_interne\":false,\"laboratoire\":\"IRAP\",\"responsable\":\"Dark Vador\"},{\"id\":\"2\",\"materiel_id\":\"1\",\"date_emprunt\":\"2010-04-05\",\"date_retour_emprunt\":\"2010-12-12\",\"piece\":\"Clavier\",\"emprunt_interne\":false,\"laboratoire\":\"IRAP\",\"responsable\":\"Woody Allen\"}]}],\"id\":\"IRAP-12-0001\"}";
    
    NSData *jsonDatax = [blabla dataUsingEncoding:NSUTF8StringEncoding];
    
    @try {
        NSError *error = nil;
        NSDictionary *res = [NSJSONSerialization JSONObjectWithData:jsonDatax options:kNilOptions error:&error];
        
        [informationLabel setText:NSLocalizedString(@"PARSINGRES", nil)];
        
        Product *simpleProduct = [[Product alloc] init];
        Product *detailedProduct = [[Product alloc] init];
        
        NSArray *results = [res objectForKey:@"materials"];
        NSDictionary* result = [results objectAtIndex:0];
        
        NSString *valueAsString;
        id value;
        
        // Creating our simple product
        NSDictionary* materiel = [result objectForKey:@"Materiel"];
        
        value = [materiel objectForKey:@"designation"];
        valueAsString = (NSString *)value;
        [simpleProduct addPropertyName:NSLocalizedString(@"DESIGNATION", nil) AndValue:valueAsString];
        [simpleProduct setName:valueAsString];
        
        value = [materiel objectForKey:@"numero_irap"];
        valueAsString = (NSString *)value;
        [simpleProduct addPropertyName:NSLocalizedString(@"NUMIRAP", nil) AndValue:valueAsString];
        
        value = [materiel objectForKey:@"organisme"];
        valueAsString = (NSString *)value;
        [simpleProduct addPropertyName:NSLocalizedString(@"PURCHASINGORGA", nil) AndValue:valueAsString];
        
        value = [materiel objectForKey:@"nom_responsable"];
        valueAsString = (NSString *)value;
        [simpleProduct addPropertyName:NSLocalizedString(@"ACCOUNTANT", nil) AndValue:valueAsString];
        
        value = [materiel objectForKey:@"email_responsable"];
        valueAsString = (NSString *)value;
        [simpleProduct addPropertyName:NSLocalizedString(@"ACCOUNTCONTACT", nil) AndValue:valueAsString];
        
        value = [materiel objectForKey:@"full_storage"];
        valueAsString = (NSString *)value;
        [simpleProduct addPropertyName:NSLocalizedString(@"LOCALIZATION", nil) AndValue:valueAsString];
        
        [simpleProduct setSectionWithName:@"Matériel"];
        
        
        //Creating a more detailed product
        [self parseDictionary:materiel ForProduct:detailedProduct];    
        [detailedProduct setSectionWithName:@"Matériel"];

        // Parsing Category
        NSDictionary* category = [result objectForKey:@"Category"];
        [self parseDictionary:category ForProduct:detailedProduct];    
        [detailedProduct setSectionWithName:@"Catégorie"];
        
        // Parsing SousCategory
        NSDictionary* subcategory = [result objectForKey:@"SousCategory"];
        [self parseDictionary:subcategory ForProduct:detailedProduct];    
        [detailedProduct setSectionWithName:@"Sous-Catégories"];
        
        [[self informationViewController] setSimpleProduct:simpleProduct];
        [[self informationViewController] setDetailedProduct:detailedProduct];
        [[self informationViewController] displaySimpleProduct];
        
        [[[self informationViewController] tableView] scrollRectToVisible:CGRectMake(0, 0, 1, 1) animated:NO];
        [[[self informationViewController] navigationItem] setTitle : [simpleProduct name]];
        
        [self.navigationController pushViewController:[self informationViewController] animated:TRUE];
        [informationLabel setHidden:YES];
    }
    @catch (NSException *exception) {
        NSLog(@"main: Caught %@: %@", [exception name], [exception reason]);
        [informationLabel setTextColor: [UIColor redColor]];
        [informationLabel setText:NSLocalizedString(@"ERRORPARSINGRES", nil)];
    }
    @finally {
        [applicationActivity stopAnimating];
        [scanButton setEnabled:true];
    }
}
@end
