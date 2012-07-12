//
//  ViewController.h
//  Inventirap
//
//  Created by Thomas Zilio on 1/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "ZXingWidgetController.h"

@class InformationViewController;

@interface ScannerViewController : UIViewController <ZXingDelegate, NSURLConnectionDelegate>

@property (weak, nonatomic) IBOutlet UIActivityIndicatorView *applicationActivity;
@property (weak, nonatomic) IBOutlet UIButton *scanButton;
@property (weak, nonatomic) IBOutlet UIButton *lastProductButton;
@property (weak, nonatomic) IBOutlet UILabel *informationLabel;
@property (weak, nonatomic) IBOutlet UILabel *lastProductLabel;

- (IBAction)scanButtonAction:(id)sender;
- (IBAction)lastProductButtonAction:(id)sender;

@end
