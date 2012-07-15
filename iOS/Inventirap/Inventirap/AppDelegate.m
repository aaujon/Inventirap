//
//  AppDelegate.m
//  Inventirap
//
//  Created by Thomas Zilio on 1/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import "AppDelegate.h"

#import "ScannerViewController.h"
#import "SettingsViewController.h"
#import "Settings.h"

@implementation AppDelegate

@synthesize window = _window;
@synthesize scannerViewController;
@synthesize settingsViewController;
@synthesize scannerNavController;
@synthesize settingsNavController;
@synthesize tabBarController;

- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions
{
    self.window = [[UIWindow alloc] initWithFrame:[[UIScreen mainScreen] bounds]];
    
    //Settings initialization
    [Settings sharedSettings];
    
    // Scanner and Settings view initialization
    if ([[UIDevice currentDevice] userInterfaceIdiom] == UIUserInterfaceIdiomPhone) {
        self.scannerViewController = [[ScannerViewController alloc] initWithNibName:@"ScannerViewController_iPhone" bundle:nil];
        self.settingsViewController = [[SettingsViewController alloc] initWithNibName:@"SettingsViewController_iPhone" bundle:nil];
    } else {
        self.scannerViewController = [[ScannerViewController alloc] initWithNibName:@"ScannerViewController_iPad" bundle:nil];
        self.settingsViewController = [[SettingsViewController alloc] initWithNibName:@"SettingsViewController_iPad" bundle:nil];
    }
    
    // Navigation and Tab Bar Controllers initialization
    self.scannerNavController = [[UINavigationController alloc] initWithRootViewController:self.scannerViewController];
    self.settingsNavController = [[UINavigationController alloc] initWithRootViewController:self.settingsViewController];
    
    self.tabBarController = [[UITabBarController alloc] init];
    self.tabBarController.viewControllers = [NSArray arrayWithObjects:self.scannerNavController, self.settingsNavController, nil];
    
    [[UINavigationBar appearance] setBackgroundImage:[UIImage imageNamed:@"navigationBar"] forBarMetrics:UIBarMetricsDefault];
    [[UINavigationBar appearance] setTitleVerticalPositionAdjustment:0.0f forBarMetrics:UIBarMetricsDefault];
    [[UINavigationBar appearance] setTitleTextAttributes:
     [NSDictionary dictionaryWithObjectsAndKeys:
      [UIColor whiteColor], UITextAttributeTextColor,
      [UIColor colorWithRed:4.0f/255 green:37.0f/255 blue:62.0f/255 alpha:1.0], UITextAttributeTextShadowColor,
      [NSValue valueWithUIOffset:UIOffsetMake(1, 1)], UITextAttributeTextShadowOffset, nil]];
    
    [[UIBarButtonItem appearance] setTintColor:[UIColor colorWithRed:12.0f/255 green:85.0f/255 blue:144.0f/255 alpha:1.0]];
	
    [[UITabBar appearance] setBackgroundImage:[UIImage imageNamed:@"tabBarBackground"]];
    [[UITabBar appearance] setSelectionIndicatorImage:[UIImage imageNamed:@"tabBarItemSelected"]];
    [[UITabBar appearance] setTintColor:[UIColor colorWithRed:221.0f/255.0f green:221.0f/255.0f blue:221.0f/255.0f alpha:1.0f]];
    
    [[UITabBarItem appearance] setTitlePositionAdjustment:UIOffsetMake(0.0f, -3.0f)];
    [[UITabBarItem appearance] setTitleTextAttributes:
     [NSDictionary dictionaryWithObjectsAndKeys:
      [UIColor whiteColor], UITextAttributeTextColor,
      [UIColor colorWithRed:4.0f/255 green:37.0f/255 blue:62.0f/255 alpha:1.0], UITextAttributeTextShadowColor,
      [NSValue valueWithUIOffset:UIOffsetMake(1, 1)], UITextAttributeTextShadowOffset, nil] forState:UIControlStateNormal];
    
    self.window.rootViewController = self.tabBarController;
    
    [self.window makeKeyAndVisible];
    return YES;
}

- (void)applicationWillResignActive:(UIApplication *)application
{
    // Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
    // Use this method to pause ongoing tasks, disable timers, and throttle down OpenGL ES frame rates. Games should use this method to pause the game.
}

- (void)applicationDidEnterBackground:(UIApplication *)application
{
    //Saving settigns
    [[Settings sharedSettings] saveSettings];
}

- (void)applicationWillEnterForeground:(UIApplication *)application
{
    // Called as part of the transition from the background to the inactive state; here you can undo many of the changes made on entering the background.
}

- (void)applicationDidBecomeActive:(UIApplication *)application
{
    // Restart any tasks that were paused (or not yet started) while the application was inactive. If the application was previously in the background, optionally refresh the user interface.
}

- (void)applicationWillTerminate:(UIApplication *)application
{
    // Called when the application is about to terminate. Save data if appropriate. See also applicationDidEnterBackground:.
}

@end
