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

#pragma mark -
#pragma mark Initialization

- (id) init
{
    self = [super init];
    
    if (self) {
        m_properties = [[NSMutableArray alloc] init];
        m_section = [[NSMutableDictionary alloc] init];
        m_sectionList = [[NSMutableArray alloc] init];
    }
    return self;
}


- (void) setName:(NSString*)name
{
    m_name = name;
}

- (NSString*) getName
{
    return m_name;
}

#pragma mark -
#pragma mark Sections methods

- (void) setSectionWithName:(NSString*)name
{
    [m_section setValue:m_properties forKey:name];
    [m_sectionList addObject:name];
    m_properties = [[NSMutableArray alloc] init];
}

- (NSString*) getSectionAtIndex:(NSUInteger)index
{
    return [m_sectionList objectAtIndex:index];
}

- (NSUInteger) getSectionsCount
{
    return [m_section count];
}

#pragma mark -
#pragma mark Properties methods

- (void) addPropertyName:(NSString*)name AndValue:(NSString*)value
{
    Property *property = [[Property alloc] initWithName:name AndValue:value];
    [m_properties addObject:property];
}

- (NSUInteger) getPropertiesNumberForSection:(NSUInteger)section
{
    return [[m_section objectForKey:[m_sectionList objectAtIndex:section]] count];
}

- (Property*) getPropertyAtIndex:(NSUInteger)index ForSection:(NSUInteger)section
{
    return [[m_section objectForKey:[m_sectionList objectAtIndex:section]] objectAtIndex:index];
}

@end
