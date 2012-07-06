//
//  ViewController.m
//  Inventirap
//
//  Created by Thomas Zilio on 1/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import "ScannerViewController.h"

#import "QRCodeReader.h"
#import  "InformationViewController.h"
#import "XMLParser.h"

@interface ScannerViewController ()

@end

@implementation ScannerViewController

@synthesize applicationActivity;
@synthesize scanResults;
@synthesize scanButton;
@synthesize informationLabel;

#pragma mark -
#pragma mark View lifecycle

- (id) initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
        
    if (self)
    {
        if ([[UIDevice currentDevice] userInterfaceIdiom] == UIUserInterfaceIdiomPhone) {
            m_informationViewController = [[InformationViewController alloc] initWithNibName:@"InformationViewController_iPhone" bundle:nil];
        } else {
            m_informationViewController = [[InformationViewController alloc] initWithNibName:@"InformationViewController_iPad" bundle:nil];
        }
        self.title = NSLocalizedString(@"Scanner", @"Scanner");
        self.tabBarItem.image = [UIImage imageNamed:@"first"];
        m_XMLParser = [[XMLParser alloc] init];
    }
    
    return self;
}

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
    NSLog(@"QRCode scanned : %@", [self scanResults]);
    
    if (YES) //[scanResults hasPrefix:@"IRAP-"])
    {
        //[applicationActivity startAnimating];
        //[scanButton setEnabled:false];
        
        [informationLabel setTextColor: [UIColor blackColor]];
        [informationLabel setText:@"Contacting WebService ..."];
        
        [m_informationViewController initData:nil];
        [self.navigationController pushViewController:m_informationViewController animated:TRUE];
        //[self sendWebServiceRequest:@"34.5.6.7"];
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
    NSString *soapMsg =
    [NSString stringWithFormat:@"<?xml version=\"1.0\" encoding=\"utf-8\"?>"
                                "<soap:Envelope"
                                    "xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope\""
                                    "soap:encodingStyle=\"http://www.w3.org/2001/12/soap-encoding\">"
                                "<soap:Body>"
                                    "<m:GetPrice xmlns:m=\"http://www.w3schools.com/prices\">"
                                    "<m:Item>Apples</m:Item>"
                                    "</m:GetPrice>"
                                "</soap:Body>"
                                "</soap:Envelope>"
                                "</xml>", ident];
    
    NSURL *url = [NSURL URLWithString:@"???"];
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url];
    
    NSString *msgLength = [NSString stringWithFormat:@"%d", [soapMsg length]];
    
    [request addValue:@"text/xml; charset=utf-8" forHTTPHeaderField:@"Content-Type"];
    [request addValue:@"???" forHTTPHeaderField:@"SOAPAction"];
    [request addValue:msgLength forHTTPHeaderField:@"Content-Length"];
    [request setHTTPMethod:@"POST"];
    [request setHTTPBody: [soapMsg dataUsingEncoding:NSUTF8StringEncoding]];
    
    m_connection = [[NSURLConnection alloc] initWithRequest:request delegate:self];
    if (m_connection)
    {
        m_webData = [NSMutableData data];
    } else {
        // TODO : handle connection failure
        [informationLabel setTextColor: [UIColor redColor]];
        [informationLabel setText:@"Error while connecting to the WebService"];
        [applicationActivity stopAnimating];
        [scanButton setEnabled:true];
        NSLog(@"FAILED");
    }
    
}

#pragma mark -
#pragma mark Connection delegate methods

- (void) connection:(NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response
{
    [m_webData setLength: 0];
}

-(void) connection:(NSURLConnection *)connection didReceiveData:(NSData *)data
{
    [m_webData appendData:data];
}

- (void) connection:(NSURLConnection *)connection didFailWithError:(NSError *)error
{
    // TODO : handle connection failure
    [informationLabel setTextColor: [UIColor redColor]];
    [informationLabel setText:@"Error while connecting to the WebService"];
    [applicationActivity stopAnimating];
    [scanButton setEnabled:true];
    NSLog(@"FAILED");
}

- (void) connectionDidFinishLoading:(NSURLConnection *)connection
{
    // Display the received XML
    NSLog(@"DONE. Received Bytes: %d", [m_webData length]);
    NSString *theXML = [[NSString alloc] initWithBytes: [m_webData mutableBytes]
                                                length:[m_webData length]
                                              encoding:NSUTF8StringEncoding];
    NSLog(@"%@", theXML);
    
    [informationLabel setText:@"Processing data ..."];
    // Transform the XML into a displayable Product
    Product *product = [m_XMLParser parseXMLResult:m_webData];
    
    [applicationActivity stopAnimating];
    [informationLabel setHidden:YES];
    [scanButton setEnabled:true];
    
    [m_informationViewController initData:product];
    
}

@end
