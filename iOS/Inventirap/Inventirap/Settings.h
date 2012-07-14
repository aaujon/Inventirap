//
//  Settings.h
//  Inventirap
//
//  Created by Thomas Zilio on 6/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface Settings : NSObject

@property (strong, nonatomic) NSString *webServiceUrl;

+ (Settings*)sharedSettings;
- (void)changeWebServiceUrl:(NSString*)newUrl;
- (void)resetSettings;
- (void)saveSettings;

@end
