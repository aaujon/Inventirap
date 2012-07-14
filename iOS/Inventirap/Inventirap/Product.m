//
//  Product.m
//  Inventirap
//
//  Created by Thomas Zilio on 2/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import "Product.h"
#import "Property.h"

@interface Product ()
{
    NSMutableArray *m_properties;
    NSMutableArray *m_sectionList;
    NSMutableDictionary *m_section;
}
@end

@implementation Product

@synthesize name;

#pragma mark -
#pragma mark Initialization

- (id)init
{
    self = [super init];
    
    if (self) {
        m_properties = [[NSMutableArray alloc] init];
        m_section = [[NSMutableDictionary alloc] init];
        m_sectionList = [[NSMutableArray alloc] init];
    }
    return self;
}

#pragma mark -
#pragma mark Sections methods

- (void)setSectionWithName:(NSString*)sectionName
{
    [m_section setValue:m_properties forKey:sectionName];
    [m_sectionList addObject:sectionName];
    m_properties = [[NSMutableArray alloc] init];
}

- (NSString*)sectionAtIndex:(NSUInteger)index
{
    return [m_sectionList objectAtIndex:index];
}

- (NSUInteger)sectionsCount
{
    return [m_section count];
}

#pragma mark -
#pragma mark Properties methods

- (void)addPropertyName:(NSString*)propertyName AndValue:(NSString*)value
{
    Property *property = [[Property alloc] initWithName:propertyName AndValue:value];
    [m_properties addObject:property];
}

- (NSUInteger)propertiesNumberForSection:(NSUInteger)section
{
    return [[m_section objectForKey:[m_sectionList objectAtIndex:section]] count];
}

- (Property*)propertyAtIndex:(NSUInteger)index ForSection:(NSUInteger)section
{
    return [[m_section objectForKey:[m_sectionList objectAtIndex:section]] objectAtIndex:index];
}

@end
