//
//  Settings.m
//  Inventirap
//
//  Created by Thomas Zilio on 6/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import "Settings.h"

@implementation Settings

@synthesize webServiceUrl;

+ (Settings*)sharedSettings
{
	static dispatch_once_t pred = 0;
    __strong static id _sharedSettings = nil;
    dispatch_once(&pred, ^{
        _sharedSettings = [[self alloc] init];
    });
    return _sharedSettings;
}


- (id)init
{
	self = [super init];
	if (self != nil) {
        
        // Reading saved settings and creating a writable file if needed
        NSError *error;
        NSArray *paths = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
        NSString *documentsDirectory = [paths objectAtIndex:0];
        NSString *path = [documentsDirectory stringByAppendingPathComponent:@"Settings.plist"];
        
        NSFileManager *fileManager = [NSFileManager defaultManager];
        
        if (![fileManager fileExistsAtPath: path]) {
            NSString *bundle = [[NSBundle mainBundle] pathForResource:@"DefaultSettings" ofType:@"plist"];
            [fileManager copyItemAtPath:bundle toPath: path error:&error];
        }
        
        NSMutableDictionary *savedSettings = [[NSMutableDictionary alloc] initWithContentsOfFile: path];
        self.webServiceUrl = [savedSettings objectForKey:@"WebServiceURL"];
	}
    
	return self;
}

- (void)changeWebServiceUrl:(NSString*)newUrl {
	[self setWebServiceUrl:newUrl];
}

- (void) resetSettings
{
    NSString *bundle = [[NSBundle mainBundle] pathForResource:@"DefaultSettings" ofType:@"plist"];
    NSMutableDictionary *savedSettings = [[NSMutableDictionary alloc] initWithContentsOfFile: bundle];
    
    [self setWebServiceUrl:[savedSettings objectForKey:@"WebServiceURL"]];
}

- (void)saveSettings
{
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
    
    //Add elements to data file and write data to file
    [data setObject:[self webServiceUrl] forKey:@"WebServiceURL"];
    [data writeToFile: path atomically:YES];
}

@end
