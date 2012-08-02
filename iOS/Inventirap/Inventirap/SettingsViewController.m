//
//  SettingsViewController.m
//  Inventirap
//
//  Created by Thomas Zilio on 01/08/12.
//
//

#import "SettingsViewController.h"
#import "KeychainItemWrapper.h"
#import "SettingsEditorViewController.h"
#import "Settings.h"

@interface SettingsViewController ()

- (NSString *) sectionTitle:(NSInteger)section;
- (NSString *) sectionContent:(NSInteger)section;

@end

enum {
	kLoginSection = 0,
	kPasswordSection,
	kServerUrlSection
};

static NSInteger kPasswordTag = 2;

@implementation SettingsViewController

@synthesize passwordItem;
@synthesize textFieldController;

#pragma mark -
#pragma mark Initialization

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    if (self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil]) {
		if ([[UIDevice currentDevice] userInterfaceIdiom] == UIUserInterfaceIdiomPhone) {
            [self setTextFieldController:[[SettingsEditorViewController alloc] initWithNibName:@"SettingsEditorViewController_iPhone" bundle:nil]];
        } else {
            [self setTextFieldController:[[SettingsEditorViewController alloc] initWithNibName:@"SettingsEditorViewController_iPad" bundle:nil]];
        }
        self.title = NSLocalizedString(@"SETTINGS", nil);
        [[self tabBarItem] setFinishedSelectedImage:[UIImage imageNamed:@"settingsTabBarIcon"] withFinishedUnselectedImage:[UIImage imageNamed:@"settingsTabBarIcon"]];
    }
    return self;
}

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
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
	
	UIImageView *tempImageView = [[UIImageView alloc] initWithImage:[UIImage imageNamed:@"ViewBackground"]];
	[tempImageView setFrame:self.tableView.frame];
	
	self.tableView.backgroundView = tempImageView;
	
    self.view.backgroundColor = [UIColor groupTableViewBackgroundColor];
	
	UIBarButtonItem *resetButton ;
	resetButton = [[UIBarButtonItem alloc] initWithTitle:NSLocalizedString(@"RESET", nil)
												   style:UIBarButtonItemStyleBordered
												  target:self
												  action:@selector(resetSettings)];
	
    self.navigationItem.leftBarButtonItem = resetButton;
}

- (void)viewDidUnload
{
    [super viewDidUnload];
	[self setTextFieldController:nil];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

#pragma mark -
#pragma mark Reset actions and utilities functions

- (void)actionSheet:(UIActionSheet *)actionSheet clickedButtonAtIndex:(NSInteger)buttonIndex
{
    if (buttonIndex == 0) {
        [[self passwordItem] resetKeychainItem];
		[[Settings sharedSettings] resetSettings];
		
        [[self tableView] reloadData];
    }
}

- (void)resetSettings
{
    UIActionSheet *actionSheet = [[UIActionSheet alloc] initWithTitle:NSLocalizedString(@"CONFIRMRESET", nil)
															 delegate:self
													cancelButtonTitle:NSLocalizedString(@"CANCEL", nil)
											   destructiveButtonTitle:NSLocalizedString(@"RESETCONF", nil)
													otherButtonTitles:nil];
    actionSheet.actionSheetStyle = UIActionSheetStyleDefault;
    [actionSheet showFromTabBar:self.tabBarController.tabBar];
}

- (void)viewWillAppear:(BOOL)animated
{
    [super viewWillAppear:animated];
    [[self tableView] reloadData];
}

- (NSString *)sectionTitle:(NSInteger)section
{
    switch (section) {
        case kLoginSection: return NSLocalizedString(@"LOGIN", nil);
        case kPasswordSection: return NSLocalizedString(@"PASSWORD", nil);
        case kServerUrlSection: return NSLocalizedString(@"WEBSERVURL", nil);
    }
    return nil;
}

- (NSString *)sectionContent:(NSInteger)section
{
    switch (section) {
        case kLoginSection:
			return [[self passwordItem] objectForKey:(__bridge id)(kSecAttrAccount)];
        case kPasswordSection:
			return [[self passwordItem] objectForKey:(__bridge id)(kSecValueData)];
        case kServerUrlSection:
			return [[Settings sharedSettings] webServiceUrl];
    }
    return nil;
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    return 3;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    return 1;
}

- (NSString *)tableView:(UITableView *)tableView titleForHeaderInSection:(NSInteger)section
{
    return [self sectionTitle:section];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
	static NSString *kNormalCellIdentifier =	@"NormalCell";
	static NSString *kPasswordCellIdentifier =	@"PasswordCell";
	
	UITableViewCell *cell = nil;
	
	switch (indexPath.section) {
		case kLoginSection:
		case kServerUrlSection:
		{
			cell = [tableView dequeueReusableCellWithIdentifier:kNormalCellIdentifier];
			if (cell == nil) {
				cell = [[UITableViewCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:kNormalCellIdentifier];
			}
			
			cell.textLabel.text = [self sectionContent:indexPath.section];
			cell.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
			
			break;
		}
			
		case kPasswordSection:
		{
			UITextField *textField = nil;
			
			cell = [tableView dequeueReusableCellWithIdentifier:kPasswordCellIdentifier];
			if (cell == nil) {
				cell = [[UITableViewCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:kPasswordCellIdentifier];
				
				textField = [[UITextField alloc] initWithFrame:CGRectInset(cell.contentView.bounds, 10, 10)];
				textField.tag = kPasswordTag;
				textField.font = [UIFont systemFontOfSize:17.0];
				
				textField.enabled = NO;
				textField.secureTextEntry = YES;
				
				[cell.contentView addSubview:textField];
			}
			else {
				textField = (UITextField *) [cell.contentView viewWithTag:kPasswordTag];
			}
			
			textField.text = [self sectionContent:indexPath.section];
			cell.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
			
			break;
		}
			
	}
    
	return cell;
}

#pragma mark - Table view delegate

- (void)tableView:(UITableView *)aTableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
	[[self tableView] deselectRowAtIndexPath:indexPath animated:YES];
	
	[self.textFieldController.editionField setPlaceholder:[self sectionTitle:indexPath.section]];
	
	[self.textFieldController.editionField setSecureTextEntry:(indexPath.section == kPasswordSection)];
	self.textFieldController.passwordItem = [self passwordItem];
	
	self.textFieldController.editionFieldValue = [self sectionContent:indexPath.section];
	self.textFieldController.editionFieldKey = indexPath.section;
	self.textFieldController.title = [self sectionTitle:indexPath.section];
	
	[self.navigationController pushViewController:textFieldController animated:YES];
}

@end
