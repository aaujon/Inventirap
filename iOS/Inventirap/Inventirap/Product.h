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
}

- (id) initWithName:(NSString*) name;
- (void) addPropertyName:(NSString*)name AndValue:(NSString*)value;
- (NSString*) getName;
- (NSUInteger) getPropertiesCount;
- (Property*) getPropertyAtIndex:(NSUInteger)index;
@end
