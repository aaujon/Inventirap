//
//  AppDelegate.h
//  Inventirap
//
//  Created by Thomas Zilio on 1/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@class ScannerViewController, SettingsViewController;

@interface AppDelegate : UIResponder <UIApplicationDelegate>

@property (strong, nonatomic) UIWindow *window;

@property (strong, nonatomic) ScannerViewController *scannerViewController;
@property (strong, nonatomic) SettingsViewController *settingsViewController;

@property (strong, nonatomic) UINavigationController *scannerNavController;
@property (strong, nonatomic) UINavigationController *settingsNavController;
@property (strong, nonatomic) UITabBarController *tabBarController;

@end
