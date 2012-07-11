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

@property (nonatomic, retain) NSString *name;

- (void) setSectionWithName:(NSString*)sectionName;
- (NSUInteger) getSectionsCount;
- (NSString*) getSectionAtIndex:(NSUInteger)index;

- (void) addPropertyName:(NSString*)propertyName AndValue:(NSString*)value;
- (NSUInteger) getPropertiesNumberForSection:(NSUInteger)section;
- (Property*) getPropertyAtIndex:(NSUInteger)index ForSection:(NSUInteger)section;
@end