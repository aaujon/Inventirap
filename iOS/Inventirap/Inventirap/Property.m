//
//  Property.m
//  Inventirap
//
//  Created by Thomas Zilio on 2/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import "Property.h"

@implementation Property

@synthesize name, value;
- (id)initWithName:(NSString*)propName AndValue:(NSString*)propValue
{
    self = [super init];
    
    if (self) {
        name = propName;
        value = propValue;
    }
    
    return self;
}

@end
