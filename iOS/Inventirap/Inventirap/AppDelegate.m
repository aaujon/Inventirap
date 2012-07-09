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
    
    [[UINavigationBar appearance] setTintColor:[UIColor grayColor]];
    
    [[UITabBar appearance] setTintColor:[UIColor grayColor]];
    //[[[self tabBarController] tabBar] setSelectedImageTintColor:[UIColor yellowColor]];
    
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
    // Use this method to release shared resources, save user data, invalidate timers, and store enough application state information to restore your application to its current state in case it is terminated later. 
    // If your application supports background execution, this method is called instead of applicationWillTerminate: when the user quits.
    
    
    // Reading saved settings and creating a writable file if needed
    NSError *error;
    NSArray *paths = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
    NSString *documentsDirectory = [paths objectAtIndex:0];
    NSString *path = [documentsDirectory stringByAppendingPathComponent:@"Settings.plist"];
    
    NSFileManager *fileManager = [NSFileManager defaultManager];
    
    if (![fileManager fileExistsAtPath: path]) {
        NSString *bundle = [[NSBundle mainBundle] pathForResource:@"Settings" ofType:@"plist"];
        [fileManager copyItemAtPath:bundle toPath: path error:&error];
    }
    
    NSMutableDictionary *data = [[NSMutableDictionary alloc] initWithContentsOfFile: path];
    
    //here add elements to data file and write data to file
    NSString *value = [[Settings sharedSettings] webServiceUrl];
    
    [data setObject:value forKey:@"WebServiceURL"];
    [data writeToFile: path atomically:YES];

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
