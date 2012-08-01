//
//  Property.h
//  Inventirap
//
//  Created by Thomas Zilio on 2/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface Property : NSObject

@property (nonatomic, copy, readonly) NSString *name;
@property (nonatomic, copy, readonly) NSString *value;

- (id)initWithName:(NSString*)propName AndValue:(NSString*)propValue;

@end
