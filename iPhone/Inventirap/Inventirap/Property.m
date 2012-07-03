//
//  Property.m
//  Inventirap
//
//  Created by Thomas Zilio on 2/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import "Property.h"

@implementation Property

- (id) initWithName:(NSString*)name AndValue:(NSString*)value
{
    self = [super init];
    
    if (self)
    {
        m_name = name;
        m_value = value;
    }
    
    return self;
}

- (NSString*) getName
{
    return m_name;
}
- (NSString*) getValue
{
    return m_value;
}

@end
