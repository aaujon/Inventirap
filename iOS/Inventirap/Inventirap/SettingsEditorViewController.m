//
//  SettingsEditorViewController.m
//  Inventirap
//
//  Created by Thomas Zilio on 01/08/12.
//
//

#import "SettingsEditorViewController.h"
#import "KeychainItemWrapper.h"
#import "Settings.h"

@interface SettingsEditorViewController ()

- (void)cancel;
- (void)save;

@end

enum {
	kLoginSection = 0,
	kPasswordSection,
	kServerUrlSection
};

@implementation SettingsEditorViewController

@synthesize passwordItem;
@synthesize editionFieldValue, editionFieldKey, editionField;

#pragma mark -
#pragma mark Initialization

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

#pragma mark -
#pragma mark View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];

    [self.editionField setFont:[UIFont boldSystemFontOfSize:16]];
	[self.editionField setDelegate:self];
	
	UIBarButtonItem *cancelButton ;
	UIBarButtonItem *saveButton ;
	
	cancelButton = [[UIBarButtonItem alloc] initWithTitle:NSLocalizedString(@"CANCEL", nil)
												   style:UIBarButtonItemStyleBordered
												  target:self
												  action:@selector(cancel)];
	saveButton = [[UIBarButtonItem alloc] initWithTitle:NSLocalizedString(@"SAVE", nil)
												   style:UIBarButtonItemStyleBordered
												  target:self
												  action:@selector(save)];
    self.navigationItem.leftBarButtonItem = cancelButton;
    self.navigationItem.rightBarButtonItem = saveButton;
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    
	[self setEditionField:nil];
}

- (void)viewDidAppear:(BOOL)animated
{
    [self.editionField becomeFirstResponder];
    [self.editionField setText:editionFieldValue];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

#pragma mark -
#pragma mark Actions functions

- (void)cancel
{
    [self.navigationController popViewControllerAnimated:YES];
}

- (void)save
{
	switch ([self editionFieldKey]) {
		case kLoginSection:
			[[self passwordItem] setObject:[self.editionField text] forKey:(__bridge id)(kSecAttrAccount)];
			break;
		case kPasswordSection:
			[[self passwordItem] setObject:[self.editionField text] forKey:(__bridge id)(kSecValueData)];
			break;
		case kServerUrlSection:
			[[Settings sharedSettings] changeWebServiceUrl:[self.editionField text]];
			break;
		default:
			break;
	}

    [self.navigationController popViewControllerAnimated:YES];
}

- (BOOL)textFieldShouldReturn:(UITextField *)textField
{
	[textField resignFirstResponder];
    [self save];
    return YES;
}

@end
