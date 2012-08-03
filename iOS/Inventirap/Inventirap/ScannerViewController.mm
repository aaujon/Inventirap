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
#import "KeychainItemWrapper.h"

#define kBgQueue dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_DEFAULT, 0)
#define kMainQueue dispatch_get_main_queue()

@interface ScannerViewController ()

@property (nonatomic, strong) InformationViewController *informationViewController;
@property (nonatomic, strong) NSMutableData *jsonData;
@property (nonatomic, strong) NSURLConnection *connection;

@property (nonatomic, copy) NSString *scanResults;

- (void)launchQRCodeReader;
- (void)processResults;
- (void) parseJsonData;

- (void)sendWebServiceRequest:(NSString*)ident;

- (void)createSection:(NSString*)section From:(NSDictionary*)dictionary withKey:(NSString*)key ForProduct:(Product*)product;
- (void)createSections:(NSString*)sectionsName From:(NSDictionary*)dictionnary withKey:(NSString*)key For:(Product*)product;
- (void) createProperty:(NSString*)propertyName From:(NSDictionary*)dictionnary withKey:(NSString*)key ForProduct:(Product*)product;
- (NSString*) checkValueValidity:(id)value;

- (void)customizeButtonLayer:(CALayer*)layer;

@end

@implementation ScannerViewController
@synthesize lastProductLabel;
@synthesize lastProductButton;

@synthesize passwordItem;
@synthesize informationViewController;
@synthesize scanResults, jsonData, connection;
@synthesize applicationActivity, scanButton, informationLabel;

#pragma mark -
#pragma mark Initialization

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    
    if (self) {
        if ([[UIDevice currentDevice] userInterfaceIdiom] == UIUserInterfaceIdiomPhone) {
            [self setInformationViewController:[[InformationViewController alloc] initWithNibName:@"InformationViewController_iPhone" bundle:nil]];
        } else {
            [self setInformationViewController:[[InformationViewController alloc] initWithNibName:@"InformationViewController_iPad" bundle:nil]];
        }
        [self setTitle:NSLocalizedString(@"SCANNER", nil)];
        [[self tabBarItem] setFinishedSelectedImage:[UIImage imageNamed:@"scannerTabBarIcon"] withFinishedUnselectedImage:[UIImage imageNamed:@"scannerTabBarIcon"]];
    }
    
    return self;
}

#pragma mark -
#pragma mark View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    CALayer *buttonLayer = [[self scanButton] layer];
    [self customizeButtonLayer:buttonLayer];
    
    [[self lastProductLabel] setTextColor:[UIColor colorWithRed:4.0f/255 green:37.0f/255 blue:62.0f/255 alpha:1.0]];
    [[self lastProductLabel] setText:NSLocalizedString(@"LASTPRODUCT", nil)];
    
    [[self scanButton] setTitleColor:[UIColor whiteColor] forState:UIControlStateNormal];
    [[self scanButton] setTitleShadowColor:[UIColor colorWithRed:4.0f/255 green:37.0f/255 blue:62.0f/255 alpha:1.0] forState:UIControlStateNormal];
    [[[self scanButton] titleLabel] setShadowOffset:CGSizeMake(1.0f, 1.0f)];

    [[self applicationActivity] setHidesWhenStopped:YES];
    [[self informationLabel] setHidden:YES];
}

- (void)viewWillAppear:(BOOL)animated
{
    if ([[self informationViewController] selectedProduct] == nil) {
        [[self lastProductButton] setHidden:YES];
        [[self lastProductLabel] setHidden:YES];
    } else {
        [[self lastProductButton] setHidden:NO];
        [[self lastProductLabel] setHidden:NO];
    }
}

- (void)viewDidUnload
{
    [self setApplicationActivity:nil];
    [self setScanButton:nil];
    [self setInformationLabel:nil];
    [self setLastProductButton:nil];
    [self setLastProductLabel:nil];
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
#pragma mark Buttons actions and parsing

- (void)customizeButtonLayer:(CALayer*)layer
{
    [layer setMasksToBounds:YES];
    [layer setCornerRadius:10.0];
    [layer setBorderWidth:1.0];
    [layer setBorderColor:[[UIColor colorWithRed:4.0f/255 green:37.0f/255 blue:62.0f/255 alpha:1.0] CGColor]];
}

- (void)launchQRCodeReader
{
    [[self informationLabel] setHidden:YES];
    
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
    [self launchQRCodeReader];
}

- (IBAction)lastProductButtonAction:(id)sender
{
    [self.navigationController pushViewController:[self informationViewController] animated:TRUE];
}

- (void)processResults
{
    if ([[self scanResults] hasPrefix:@"IRAP-"]) {
        [[self applicationActivity] startAnimating];
        [[self scanButton] setEnabled:false];
        
        [[self informationLabel] setTextColor: [UIColor colorWithRed:4.0f/255 green:37.0f/255 blue:62.0f/255 alpha:1.0]];
        [[self informationLabel] setText:NSLocalizedString(@"CONTACTWEBSERV", nil)];
        
        [self sendWebServiceRequest:[self scanResults]];
    } else {
        [[self informationLabel] setTextColor: [UIColor redColor]];
        [[self informationLabel] setText:NSLocalizedString(@"INVALIDQRCODE", nil)];
    }
    [[self informationLabel] setHidden:NO];
    
}

- (void) parseJsonData
{
    @try {
        NSError *error = nil;
        NSDictionary *res = [NSJSONSerialization JSONObjectWithData:[self jsonData] options:kNilOptions error:&error];
        
        if (res == NULL) {
            [NSException raise:@"Invalid web service response" format:@"json results are incorrect : %@", res];
        }
        
        Product *simpleProduct = [[Product alloc] init];
        Product *detailedProduct = [[Product alloc] init];
        
        NSArray *results = [res objectForKey:@"materials"];
        NSDictionary* result = [results objectAtIndex:0];
        
        // Creating our simple product
        NSDictionary* materiel = [result objectForKey:@"Materiel"];
        
        [self createProperty:NSLocalizedString(@"DESIGNATION", nil) From:materiel withKey:@"designation" ForProduct:simpleProduct];
        [self createProperty:NSLocalizedString(@"NUMIRAP", nil) From:materiel withKey:@"numero_irap" ForProduct:simpleProduct];
        [self createProperty:NSLocalizedString(@"PURCHASINGORGA", nil) From:materiel withKey:@"organisme" ForProduct:simpleProduct];
        [self createProperty:NSLocalizedString(@"ACCOUNTANT", nil) From:materiel withKey:@"nom_responsable" ForProduct:simpleProduct];
        [self createProperty:NSLocalizedString(@"ACCOUNTCONTACT", nil) From:materiel withKey:@"email_responsable" ForProduct:simpleProduct];
        [self createProperty:NSLocalizedString(@"LOCALIZATION", nil) From:materiel withKey:@"full_storage" ForProduct:simpleProduct];
        
        [simpleProduct setSectionWithName:NSLocalizedString(@"MATERIAL", nil)];
        
        
        //Creating a more detailed product
        [self createSection:NSLocalizedString(@"MATERIAL", nil) From:result withKey:@"Materiel" ForProduct:detailedProduct];
        [self createSection:NSLocalizedString(@"CATEGORY", nil) From:result withKey:@"Category" ForProduct:detailedProduct];
        [self createSection:NSLocalizedString(@"SUBCATEGORY", nil) From:result withKey:@"SousCategory" ForProduct:detailedProduct];
        [self createSection:NSLocalizedString(@"THEMATICGROUP", nil) From:result withKey:@"ThematicGroup" ForProduct:detailedProduct];
        [self createSection:NSLocalizedString(@"WORKGROUP", nil) From:result withKey:@"WorkGroup" ForProduct:detailedProduct];
        
        [self createSections:NSLocalizedString(@"BORROWING", nil) From:result withKey:@"Emprunt" For:detailedProduct];
        [self createSections:NSLocalizedString(@"MONITORING", nil) From:result withKey:@"Suivi" For:detailedProduct];
        
        // Setting the information view
        [[self informationViewController] setSimpleProduct:simpleProduct];
        [[self informationViewController] setDetailedProduct:detailedProduct];
        [[self informationViewController] displaySimpleProduct];
        
        dispatch_sync(kMainQueue, ^{
            [[[self informationViewController] tableView] scrollRectToVisible:CGRectMake(0, 0, 1, 1) animated:NO];
            [[[self informationViewController] navigationItem] setTitle : [simpleProduct name]];
            
            [self.navigationController pushViewController:[self informationViewController] animated:TRUE];
            [[self informationLabel] setHidden:YES];
        });
    }
    @catch (NSException *exception) {
        NSLog(@"main: Caught %@: %@", [exception name], [exception reason]);
        dispatch_sync(kMainQueue, ^{
            [[self informationLabel] setTextColor: [UIColor redColor]];
			
			NSString *stringRes = [[NSString alloc] initWithData:[self jsonData] encoding:NSASCIIStringEncoding];
			
			if ([stringRes isEqualToString:@"Erreur d'authentification"]) {
				[[self informationLabel] setText:NSLocalizedString(@"ERRORLOGIN", nil)];
			} else {
				[[self informationLabel] setText:NSLocalizedString(@"ERRORPARSINGRES", nil)];
			}
        });
    }
    @finally {
        dispatch_sync(kMainQueue, ^{
            [[self applicationActivity] stopAnimating];
            [[self scanButton] setEnabled:true];
        });
    }
}

#pragma mark -
#pragma mark Scan processing

- (void)sendWebServiceRequest:(NSString*)ident
{
    NSString *completeURL = [NSString stringWithFormat:@"%@%@/%@/%@",[[Settings sharedSettings] webServiceUrl], ident,
							 [[self passwordItem] objectForKey:(__bridge id)(kSecAttrAccount)],
							 [[self passwordItem] objectForKey:(__bridge id)(kSecValueData)]];
    
    NSURLRequest *request = [NSURLRequest requestWithURL:[NSURL URLWithString:completeURL] cachePolicy:NSURLRequestReloadIgnoringCacheData timeoutInterval:15];
    
    [self setConnection:[[NSURLConnection alloc] initWithRequest:request delegate:self]];
    if ([self connection]) {
        [self setJsonData:[NSMutableData data]];
    } else {
        [[self informationLabel] setTextColor: [UIColor redColor]];
        [[self informationLabel] setText:NSLocalizedString(@"ERRORCONNECTWEBSERV", nil)];
        [[self applicationActivity] stopAnimating];
        [[self scanButton] setEnabled:true];
    }
    
}

- (void)createSection:(NSString*)sectionName From:(NSDictionary*)dictionary withKey:(NSString*)key ForProduct:(Product*)product
{
    if (key != nil)
        dictionary = [dictionary objectForKey:key];
    NSString *keyAsString;
    NSString *valueAsString;
    
    for(id key in dictionary) {
        id value = [dictionary objectForKey:key];
        keyAsString = [NSString stringWithFormat:@"%@",key];
        valueAsString = [self checkValueValidity:value];
        
        if ([keyAsString isEqualToString:@"designation"]) {
            [product setName:valueAsString];
        }
        
        [product addPropertyName:keyAsString AndValue:valueAsString];
    }
    [product setSectionWithName:sectionName];
}

- (void)createSections:(NSString*)sectionsName From:(NSDictionary*)dictionnary withKey:(NSString*)key For:(Product*)product
{
    NSArray *array = [dictionnary objectForKey:key];
    int i = 1;
    for (NSDictionary *element in array) {
        [self createSection:[NSString stringWithFormat:@"%@ %d", sectionsName, i] From:element withKey:nil ForProduct:product];
        i++;
    }
}

- (void) createProperty:(NSString*)propertyName From:(NSDictionary*)dictionnary withKey:(NSString*)key ForProduct:(Product*)product
{
    id value = [dictionnary objectForKey:key];
    NSString *valueAsString = [self checkValueValidity:value];
    [product addPropertyName:propertyName AndValue:valueAsString];
    
    if ([key isEqualToString:@"designation"]) {
        [product setName:valueAsString];
    }
}

- (NSString*)checkValueValidity:(id)value
{
    NSString *validValue;
    
    if ([value isKindOfClass:[NSNull class]]) {
        validValue = @"";
    } else {
        if ([value isKindOfClass:[NSNumber class]]) {
            if ([value boolValue])
                validValue = NSLocalizedString(@"YES", nil);
            else {
                validValue = NSLocalizedString(@"NO", nil);
            }
        } else {
            validValue = [NSString stringWithFormat:@"%@",value];
        }
    }
    return validValue;
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
#pragma mark Connection delegate methods

- (void)connection:(NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response
{
    [[self jsonData] setLength:0];
}

-(void) connection:(NSURLConnection *)connection didReceiveData:(NSData *)data
{
    [[self jsonData] appendData:data];
}

- (void)connection:(NSURLConnection *)connection didFailWithError:(NSError *)error
{
	NSLog(@"%@", [error localizedDescription]);
	
    [[self informationLabel] setTextColor: [UIColor redColor]];
    [[self informationLabel] setText:NSLocalizedString(@"ERRORCONNECTWEBSERV", nil)];
    [[self applicationActivity] stopAnimating];
    [[self scanButton] setEnabled:true];
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection
{
    [[self informationLabel] setText:NSLocalizedString(@"PARSINGRES", nil)];
    
    dispatch_async(kBgQueue, ^{
        [self parseJsonData];
    });
}

- (NSCachedURLResponse *)connection:(NSURLConnection *)connection willCacheResponse:(NSCachedURLResponse *)cachedResponse
{
    return nil;
}

- (BOOL)connection:(NSURLConnection *)connection canAuthenticateAgainstProtectionSpace:(NSURLProtectionSpace *)protectionSpace {
    return YES;
}

- (void)connection:(NSURLConnection *)connection didReceiveAuthenticationChallenge:(NSURLAuthenticationChallenge *)challenge {
    [challenge.sender useCredential:[NSURLCredential credentialForTrust:challenge.protectionSpace.serverTrust] forAuthenticationChallenge:challenge];
}

@end
