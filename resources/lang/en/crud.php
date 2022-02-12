<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'no_telepon' => 'No Telepon',
            'password' => 'Password',
        ],
    ],

    'product_categories' => [
        'name' => 'Product Categories',
        'index_title' => 'ProductCategories List',
        'new_title' => 'New Product service category',
        'create_title' => 'Create ProductCategory',
        'edit_title' => 'Edit ProductCategory',
        'show_title' => 'Show ProductCategory',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'products' => [
        'name' => 'Products',
        'index_title' => 'Products List',
        'new_title' => 'New Product service',
        'create_title' => 'Create Product',
        'edit_title' => 'Edit Product',
        'show_title' => 'Show Product',
        'inputs' => [
            'code' => 'Code',
            'name' => 'Name',
            'brand' => 'Brand',
            'condition' => 'Condition',
            'attribute' => 'Attribute',
            'problem' => 'Problem',
            'specification' => 'Specification',
            'image' => 'Image',
            'status' => 'Status',
            'product_category_id' => 'Product Category',
            'user_id' => 'User',
        ],
    ],

    'services' => [
        'name' => 'Services',
        'index_title' => 'Services List',
        'new_title' => 'New Service',
        'create_title' => 'Create Service',
        'edit_title' => 'Edit Service',
        'show_title' => 'Show Service',
        'inputs' => [
            'product_id' => 'Timeline',
            'user_id' => 'User',
        ],
    ],

    'timelines' => [
        'name' => 'Timelines',
        'index_title' => 'Timelines List',
        'new_title' => 'New Timeline',
        'create_title' => 'Create Timeline',
        'edit_title' => 'Edit Timeline',
        'show_title' => 'Show Timeline',
        'inputs' => [
            'message' => 'Message',
            'service_id' => 'Service',
        ],
    ],

    'product_service_categories' => [
        'name' => 'Product Service Categories',
        'index_title' => 'ProductServiceCategories List',
        'new_title' => 'New Product service category',
        'create_title' => 'Create ProductServiceCategory',
        'edit_title' => 'Edit ProductServiceCategory',
        'show_title' => 'Show ProductServiceCategory',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'product_images' => [
        'name' => 'Product Images',
        'index_title' => 'ProductImages List',
        'new_title' => 'New Product image',
        'create_title' => 'Create ProductImage',
        'edit_title' => 'Edit ProductImage',
        'show_title' => 'Show ProductImage',
        'inputs' => [
            'image' => 'Image',
            'product_id' => 'Product',
        ],
    ],

    'all_orders' => [
        'name' => 'All Orders',
        'index_title' => 'AllOrders List',
        'new_title' => 'New Orders',
        'create_title' => 'Create Orders',
        'edit_title' => 'Edit Orders',
        'show_title' => 'Show Orders',
        'inputs' => [
            'price' => 'Price',
            'status' => 'Status',
            'user_id' => 'User',
        ],
    ],

    'category_products' => [
        'name' => 'Category Products',
        'index_title' => 'CategoryProducts List',
        'new_title' => 'New Category product',
        'create_title' => 'Create CategoryProduct',
        'edit_title' => 'Edit CategoryProduct',
        'show_title' => 'Show CategoryProduct',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'product_services' => [
        'name' => 'Product Services',
        'index_title' => 'ProductServices List',
        'new_title' => 'New Product service',
        'create_title' => 'Create ProductService',
        'edit_title' => 'Edit ProductService',
        'show_title' => 'Show ProductService',
        'inputs' => [
            'code' => 'Code',
            'name' => 'Name',
            'brand' => 'Brand',
            'condition' => 'Condition',
            'attribute' => 'Attribute',
            'problem' => 'Problem',
            'specification' => 'Specification',
            'image' => 'Image',
            'status' => 'Status',
            'product_category_id' => 'Product Category',
            'user_id' => 'User',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
