//
//  Product.h
//  Inventirap
//
//  Created by Thomas Zilio on 2/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>

@class Property;

@interface Product : NSObject
{
    NSString *m_name;
    NSMutableArray *m_properties;
    NSMutableArray *m_sectionList;
    NSMutableDictionary *m_section;
}

- (id) init;
- (void) setName:(NSString*)name;
- (NSString*) getName;

- (void) setSectionWithName:(NSString*)name;
- (NSUInteger) getSectionsCount;
- (NSString*) getSectionAtIndex:(NSUInteger)index;

- (void) addPropertyName:(NSString*)name AndValue:(NSString*)value;
- (NSUInteger) getPropertiesNumberForSection:(NSUInteger)section;
- (Property*) getPropertyAtIndex:(NSUInteger)index ForSection:(NSUInteger)section;
@end
