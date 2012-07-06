//
//  XMLParser.h
//  Inventirap
//
//  Created by Thomas Zilio on 3/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>

@class Product;

@interface XMLParser : NSObject <NSXMLParserDelegate>
{
    NSMutableString *m_soapResults;
    NSXMLParser *m_xmlParser;
    Boolean m_elementFound;
}

- (Product*) parseXMLResult:(NSMutableData*)webData;

@end
