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

@property (nonatomic, copy) NSString *name;

- (void)setSectionWithName:(NSString*)sectionName;
- (NSUInteger)sectionsCount;
- (NSString*)sectionAtIndex:(NSUInteger)index;

- (void)addPropertyName:(NSString*)propertyName AndValue:(NSString*)value;
- (NSUInteger)propertiesNumberForSection:(NSUInteger)section;
- (Property*)propertyAtIndex:(NSUInteger)index ForSection:(NSUInteger)section;
@end
