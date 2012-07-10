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

@property (nonatomic, retain) Product *selectedProduct;
@property (nonatomic, retain) Product *simpleProduct;
@property (nonatomic, retain) Product *detailedProduct;

- (void) displaySimpleProduct;
- (void) displayDetailedProduct;

@end
