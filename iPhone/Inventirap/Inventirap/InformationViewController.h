//
//  InformationViewController.h
//  Inventirap
//
//  Created by Thomas Zilio on 1/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@class Product;

@interface InformationViewController : UITableViewController
{
    Product *m_product;    
}

- (void) initData:(Product *)data;
@end
