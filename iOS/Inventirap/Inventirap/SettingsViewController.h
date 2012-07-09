//
//  SettingsViewController.h
//  Inventirap
//
//  Created by Thomas Zilio on 6/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface SettingsViewController : UIViewController

@property (weak, nonatomic) IBOutlet UITextField *webServiceUrlTextField;

- (IBAction)backgroundTouch:(id)sender;
- (IBAction)resetButton:(id)sender;
@end
