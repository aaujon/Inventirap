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

@interface ScannerViewController : UIViewController <ZXingDelegate, NSURLConnectionDelegate> {
    
    InformationViewController *m_informationViewController;
    
    NSMutableData *m_jsonData;
    NSURLConnection *m_connection;
}

@property (nonatomic, copy) NSString *scanResults;
@property (weak, nonatomic) IBOutlet UIActivityIndicatorView *applicationActivity;
@property (weak, nonatomic) IBOutlet UIButton *scanButton;
@property (weak, nonatomic) IBOutlet UILabel *informationLabel;

- (void) launchQRCodeReader;
- (IBAction) scanButtonAction:(id)sender;

@end
