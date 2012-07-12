//
//  InformationViewController.m
//  Inventirap
//
//  Created by Thomas Zilio on 1/07/12.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import "InformationViewController.h"

#import "QuartzCore/QuartzCore.h"
#import "Product.h"
#import "Property.h"
#import "CustomCell.h"

@interface InformationViewController ()

@property (nonatomic) Boolean isSimpleProductDisplayed;

@end

@implementation InformationViewController

@synthesize simpleProduct, detailedProduct, selectedProduct;
@synthesize isSimpleProductDisplayed;

#pragma mark -
#pragma mark Initialization

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
    if (self) {
        // Custom initialization
    }
    return self;
}

#pragma mark -
#pragma mark View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];

#warning Change button look
    /*
    UIButton* infoButton = [UIButton buttonWithType:UIButtonTypeInfoDark];
    [infoButton addTarget:self action:@selector(detailsButtonAction) forControlEvents:UIControlEventTouchUpInside];
    UIBarButtonItem *detailsButton = [[UIBarButtonItem alloc] initWithCustomView:infoButton];*/
    
    UIImageView *tempImageView = [[UIImageView alloc] initWithImage:[UIImage imageNamed:@"ViewBackground"]];
    [tempImageView setFrame:self.tableView.frame]; 
    [self.tableView setBackgroundView:tempImageView];
    
    UIBarButtonItem *detailsButton = [[UIBarButtonItem alloc] 
                                   initWithTitle:NSLocalizedString(@"MORE", nil)                                            
                                   style:UIBarButtonItemStyleBordered 
                                   target:self 
                                   action:@selector(detailsButtonAction)];
    self.navigationItem.rightBarButtonItem = detailsButton;
    
    [self setIsSimpleProductDisplayed:YES];
    
    [self.tableView setRowHeight:50];
    [self.tableView setShowsVerticalScrollIndicator:NO];
}

- (void)viewDidUnload
{
    [super viewDidUnload];
}

- (void) animateTransition
{
    CATransition *animation = [CATransition animation];
    [animation setType:kCATransitionFade];
    [animation setTimingFunction:[CAMediaTimingFunction functionWithName:kCAMediaTimingFunctionEaseInEaseOut]];
    [animation setFillMode:kCAFillModeBoth];
    [animation setDuration:.4];
    [[self.tableView layer] addAnimation:animation forKey:@"UITableViewReloadDataAnimationKey"];
}

- (void)detailsButtonAction
{
    if ([self isSimpleProductDisplayed]) {
        [self displayDetailedProduct];
    } else {
        [self displaySimpleProduct];
    }
}

- (void)displaySimpleProduct
{
    [self setSelectedProduct:[self simpleProduct]];
    [[[self navigationItem] rightBarButtonItem] setTitle:NSLocalizedString(@"MORE", nil)];
    [self setIsSimpleProductDisplayed:YES];
    [self.tableView reloadData];
    [self animateTransition];
}

- (void)displayDetailedProduct
{
    [self setSelectedProduct:[self detailedProduct]];
    [[[self navigationItem] rightBarButtonItem] setTitle:NSLocalizedString(@"LESS", nil)];
    [self setIsSimpleProductDisplayed:NO];
    [self.tableView reloadData];
    [self animateTransition];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

#pragma mark -
#pragma mark Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    return [[self selectedProduct] getSectionsCount];
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    return [[self selectedProduct] getPropertiesNumberForSection:section];
}


- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    static NSString *CellIdentifier = @"CustomCell";
    CustomCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    
    if (cell == nil) {
        UIViewController *temporaryController = [[UIViewController alloc] initWithNibName:@"CustomCell" bundle:nil];
        cell = (CustomCell *)temporaryController.view;
    }
    
    NSString *label = [[[self selectedProduct] getPropertyAtIndex:indexPath.row ForSection:[indexPath section]] name];
    NSString *description = [[[self selectedProduct] getPropertyAtIndex:indexPath.row ForSection:[indexPath section]] value];
    
    cell.nameLabel.text = label;
    cell.descriptionLabel.text = description;

    return cell;
}

- (UIView *)tableView:(UITableView *)tableView viewForHeaderInSection:(NSInteger)section
{
	UIView* customView = [[UIView alloc] initWithFrame:CGRectMake(0.0, 0.0, 320.0, 20.0)];

	UILabel * headerLabel = [[UILabel alloc] initWithFrame:CGRectZero];
	headerLabel.backgroundColor = [UIColor colorWithRed:4.0f/255 green:37.0f/255 blue:62.0f/255 alpha:1.0];
	headerLabel.opaque = YES;
	headerLabel.textColor = [UIColor whiteColor];
	headerLabel.font = [UIFont boldSystemFontOfSize:14];
	headerLabel.frame = CGRectMake(0.0, 0.0, 320.0, 20.0);
    headerLabel.textAlignment = UITextAlignmentCenter;
    
	headerLabel.text = [[self selectedProduct] getSectionAtIndex:section];
	[customView addSubview:headerLabel];
    
	return customView;
}

- (void)tableView:(UITableView *)tableView willDisplayCell:(UITableViewCell *)cell forRowAtIndexPath:(NSIndexPath *)indexPath {
    NSUInteger row = [indexPath row];
    if (row % 2 == 0) {
        cell.backgroundColor = [UIColor colorWithRed:0.92 green:0.92 blue:0.92 alpha:1.0];
    } else {
        cell.backgroundColor = [UIColor colorWithRed:0.892 green:0.893 blue:0.892 alpha:1.0];
    }
}

- (CGFloat) tableView:(UITableView *)tableView heightForHeaderInSection:(NSInteger)section
{
	return 20.0;
}

// Removing seperation lines below last cells (when there are only few)
- (UIView *)tableView:(UITableView *)tableView viewForFooterInSection:(NSInteger)section {
    if ([self numberOfSectionsInTableView:tableView] == (section+1)){
        return [UIView new];
    }       
    return nil;
}

- (float)tableView:(UITableView *)tableView heightForFooterInSection:(NSInteger)section {
    return 0.01f;
}


@end
