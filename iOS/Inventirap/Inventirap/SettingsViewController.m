//
//  SettingsViewController.m
//  Inventirap
//
//  Created by Thomas Zilio on 6/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import "SettingsViewController.h"
#import "Settings.h"

@interface SettingsViewController ()

@end

@implementation SettingsViewController
@synthesize webServiceUrlTextField;

#pragma mark -
#pragma mark Initialization

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
#warning Replace with correct images
        self.title = NSLocalizedString(@"SETTINGS", nil);
        self.tabBarItem.image = [UIImage imageNamed:@"settingsTabBarIcon"];
    }
    return self;
}

#pragma mark -
#pragma mark View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    [self.webServiceUrlTextField setText:[[Settings sharedSettings] webServiceUrl]];
}

- (void)viewDidUnload
{
    [self setWebServiceUrlTextField:nil];
    [super viewDidUnload];
}

#pragma mark -
#pragma mark Interface interactions

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

- (IBAction)resetButton:(id)sender
{
    NSString *bundle = [[NSBundle mainBundle] pathForResource:@"DefaultSettings" ofType:@"plist"];
    NSMutableDictionary *savedSettings = [[NSMutableDictionary alloc] initWithContentsOfFile: bundle];
    
    [[Settings sharedSettings] changeWebServiceUrl:[savedSettings objectForKey:@"WebServiceURL"]];
    
    [webServiceUrlTextField setText:[[Settings sharedSettings] webServiceUrl]];
}

- (IBAction)backgroundTouch:(id)sender {
    [webServiceUrlTextField resignFirstResponder];
}

- (BOOL)textFieldShouldReturn:(UITextField *)textField
{
    [textField resignFirstResponder];
    return YES;
}

- (void)textFieldDidEndEditing:(UITextField *)textField
{
    [[Settings sharedSettings] changeWebServiceUrl:textField.text];
}
@end
