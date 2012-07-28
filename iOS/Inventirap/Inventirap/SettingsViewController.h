//
//  SettingsViewController.h
//  Inventirap
//
//  Created by Thomas Zilio on 6/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@class KeychainItemWrapper;

@interface SettingsViewController : UIViewController

@property (nonatomic, strong) KeychainItemWrapper *passwordItem;
@property (weak, nonatomic) IBOutlet UILabel *loginLabel;
@property (weak, nonatomic) IBOutlet UITextField *loginTextField;
@property (weak, nonatomic) IBOutlet UILabel *passwordLabel;
@property (weak, nonatomic) IBOutlet UITextField *passwordTextField;
@property (weak, nonatomic) IBOutlet UILabel *webServiceUrlLabel;
@property (weak, nonatomic) IBOutlet UITextField *webServiceUrlTextField;

@property (weak, nonatomic) IBOutlet UIButton *resetButton;

- (IBAction)backgroundTouch:(id)sender;
- (IBAction)resetButtonAction:(id)sender;
@end
