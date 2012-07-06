//
//  XMLParser.m
//  Inventirap
//
//  Created by Thomas Zilio on 3/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import "XMLParser.h"

#import "Product.h"

@implementation XMLParser

- (Product*) parseXMLResult:(NSMutableData*)webData
{
    m_xmlParser = [[NSXMLParser alloc] initWithData: webData];
    [m_xmlParser setDelegate: self];
    [m_xmlParser setShouldResolveExternalEntities:YES];
    [m_xmlParser parse];
    
    return nil;
}

#pragma mark -
#pragma mark NSXMLParser delegate methods

-(void) parser:(NSXMLParser *) parser didStartElement:(NSString *) elementName namespaceURI:(NSString *) namespaceURI
 qualifiedName:(NSString *) qName attributes:(NSDictionary *) attributeDict
{
    if( [elementName isEqualToString:@"Country"])
    {
        if (!m_soapResults)
        {
            m_soapResults = [[NSMutableString alloc] init];
        }
        m_elementFound = YES;
    }
}

-(void)parser:(NSXMLParser *) parser foundCharacters:(NSString *)string
{
    if (m_elementFound)
    {
        [m_soapResults appendString: string];
    }
}

-(void)parser:(NSXMLParser *)parser didEndElement:(NSString *)elementName
 namespaceURI:(NSString *)namespaceURI
qualifiedName:(NSString *)qName
{
    if ([elementName isEqualToString:@"Country"])
    {
        NSLog(@"%@", m_soapResults);
        
        UIAlertView *alert = [[UIAlertView alloc]
                              initWithTitle:@"Country found!"
                              message:m_soapResults
                              delegate:self
                              cancelButtonTitle:@"OK"
                              otherButtonTitles:nil];
        [alert show];
        [m_soapResults setString:@""];
        m_elementFound = FALSE;
    }
}

/*
 - (void)parserDidStartDocument:(NSXMLParser *)parser
 {
 
 }
 
 - (void)parserDidEndDocument:(NSXMLParser *)parser
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser validationErrorOccurred:(NSError *)validError
 {
 
 }
 
 - (NSData *)parser:(NSXMLParser *)parser resolveExternalEntityName:(NSString *)entityName systemID:(NSString *)systemID
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser parseErrorOccurred:(NSError *)parseError
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser foundUnparsedEntityDeclarationWithName:(NSString *)name publicID:(NSString *)publicID systemID:(NSString *)systemID notationName:(NSString *)notationName
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser foundProcessingInstructionWithTarget:(NSString *)target data:(NSString *)data
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser foundNotationDeclarationWithName:(NSString *)name publicID:(NSString *)publicID systemID:(NSString *)systemID
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser foundInternalEntityDeclarationWithName:(NSString *)name value:(NSString *)value
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser foundIgnorableWhitespace:(NSString *)whitespaceString
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser foundExternalEntityDeclarationWithName:(NSString *)entityName publicID:(NSString *)publicID systemID:(NSString *)systemID
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser foundElementDeclarationWithName:(NSString *)elementName model:(NSString *)model
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser foundComment:(NSString *)comment
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser foundCDATA:(NSData *)CDATABlock
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser foundAttributeDeclarationWithName:(NSString *)attributeName forElement:(NSString *)elementName type:(NSString *)type defaultValue:(NSString *)defaultValue
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser didStartMappingPrefix:(NSString *)prefix toURI:(NSString *)namespaceURI
 {
 
 }
 
 - (void)parser:(NSXMLParser *)parser didEndMappingPrefix:(NSString *)prefix
 {
 
 }*/


@end
