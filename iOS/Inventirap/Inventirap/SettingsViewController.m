//
//  SettingsViewController.m
//  Inventirap
//
//  Created by Thomas Zilio on 6/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import "SettingsViewController.h"
#import "Settings.h"
#import <QuartzCore/QuartzCore.h>

@interface SettingsViewController ()

@end

@implementation SettingsViewController
@synthesize webServiceUrlTextField;
@synthesize resetButton;
@synthesize webServiceUrlLabel;

#pragma mark -
#pragma mark Initialization

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        self.title = NSLocalizedString(@"SETTINGS", nil);
        [[self tabBarItem] setFinishedSelectedImage:[UIImage imageNamed:@"settingsTabBarIcon"] withFinishedUnselectedImage:[UIImage imageNamed:@"settingsTabBarIcon"]];
    }
    return self;
}

#pragma mark -
#pragma mark View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    CALayer *layer = [[self resetButton] layer];
    [layer setMasksToBounds:YES];
    [layer setCornerRadius:10.0];
    [layer setBorderWidth:1.0];
    [layer setBorderColor:[[UIColor colorWithRed:4.0f/255 green:37.0f/255 blue:62.0f/255 alpha:1.0] CGColor]];
    
    [[self resetButton] setTitle:NSLocalizedString(@"RESETDEFAULT", nil) forState:UIControlStateNormal];
    [[self resetButton] setTitleColor:[UIColor whiteColor] forState:UIControlStateNormal];
    [[self resetButton] setTitleShadowColor:[UIColor colorWithRed:4.0f/255 green:37.0f/255 blue:62.0f/255 alpha:1.0] forState:UIControlStateNormal];
    [[[self resetButton] titleLabel] setShadowOffset:CGSizeMake(1.0f, 1.0f)];
    
    [[self webServiceUrlLabel] setText:NSLocalizedString(@"WEBSERVURL", nil)];
    [self.webServiceUrlTextField setText:[[Settings sharedSettings] webServiceUrl]];
}

- (void)viewDidUnload
{
    [self setWebServiceUrlTextField:nil];
    [self setResetButton:nil];
    [self setWebServiceUrlLabel:nil];
    [self setWebServiceUrlLabel:nil];
    [super viewDidUnload];
}

#pragma mark -
#pragma mark Interface interactions

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

- (IBAction)resetButtonAction:(id)sender
{
    [[Settings sharedSettings] resetSettings];
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
