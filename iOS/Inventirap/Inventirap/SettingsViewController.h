//
//  SettingsViewController.h
//  Inventirap
//
//  Created by Thomas Zilio on 01/08/12.
//
//

#import <UIKit/UIKit.h>

@class SettingsEditorViewController;
@class KeychainItemWrapper;

@interface SettingsViewController : UITableViewController <UIActionSheetDelegate>


@property (nonatomic, strong) SettingsEditorViewController *textFieldController;
@property (nonatomic, strong) KeychainItemWrapper *passwordItem;

@end
