//
//  Property.h
//  Inventirap
//
//  Created by Thomas Zilio on 2/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface Property : NSObject
{
    NSString* m_name;
    NSString* m_value;
}

- (id) initWithName:(NSString*)name AndValue:(NSString*)value;
- (NSString*) getName;
- (NSString*) getValue;
@end
