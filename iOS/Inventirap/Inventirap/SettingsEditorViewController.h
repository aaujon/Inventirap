//
//  SettingsEditorViewController.h
//  Inventirap
//
//  Created by Thomas Zilio on 01/08/12.
//
//

#import <UIKit/UIKit.h>

@class KeychainItemWrapper;

@interface SettingsEditorViewController : UIViewController <UITextFieldDelegate>

@property (nonatomic, strong) KeychainItemWrapper *passwordItem;
@property (nonatomic, strong) NSString *editionFieldValue;
@property (nonatomic) NSInteger editionFieldKey;
@property (nonatomic, strong) IBOutlet UITextField *editionField;

@end
