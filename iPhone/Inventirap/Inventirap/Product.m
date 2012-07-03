//
//  Product.m
//  Inventirap
//
//  Created by Thomas Zilio on 2/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import "Product.h"
#import "Property.h"

@implementation Product

- (id) initWithName:(NSString*) name
{
    self = [super init];
    
    if (self) {
        m_name = name;
        m_properties = [[NSMutableArray alloc] init];
    }
    return self;
}

- (void) addPropertyName:(NSString*)name AndValue:(NSString*)value
{
    Property *property = [[Property alloc] initWithName:name AndValue:value];
    [m_properties addObject:property];
    
}

- (NSString*) getName
{
    return m_name;
}

- (NSUInteger) getPropertiesCount
{
    return [m_properties count];
}

- (Property*) getPropertyAtIndex:(NSUInteger)index
{
    return [m_properties objectAtIndex:index];
}

@end
