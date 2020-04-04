CREATE DATABASE e_commerce_119a61 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE e_commerce_119a61;

CREATE TABLE product_type (
    id INT UNSIGNED AUTO_INCREMENT,
    code CHAR (255) UNIQUE,
    name CHAR (255),
    PRIMARY KEY (id)
);

CREATE TABLE attribute_group (
    id INT UNSIGNED AUTO_INCREMENT,
    code CHAR (255) UNIQUE,
    name CHAR (255),
    description CHAR (255),
    display CHAR (255),
    PRIMARY KEY (id)
);

CREATE TABLE attribute (
    id INT UNSIGNED AUTO_INCREMENT,
    code CHAR (255) UNIQUE,
    name CHAR (255),
    description CHAR (255),
    type ENUM ("text", "number"),
    metadata CHAR (255),
    PRIMARY KEY (id)
);

CREATE TABLE product (
    id INT UNSIGNED AUTO_INCREMENT,
    sku CHAR (255) UNIQUE,
    name CHAR (255),
    type INT UNSIGNED,
    price DECIMAL(8, 2) UNSIGNED,
    quantity INT UNSIGNED,
    attribute_groups JSON,
    PRIMARY KEY (id),
    FOREIGN KEY (type) REFERENCES product_type (id) ON DELETE SET NULL
);

CREATE TABLE product_type_attribute_group (
    product_type INT UNSIGNED,
    attribute_group INT UNSIGNED,
    FOREIGN KEY (product_type) REFERENCES product_type (id) ON DELETE CASCADE,
    FOREIGN KEY (attribute_group) REFERENCES attribute_group (id) ON DELETE CASCADE
);

CREATE TABLE attribute_group_attribute (
    id INT UNSIGNED AUTO_INCREMENT,
    attribute_group INT UNSIGNED,
    attribute INT UNSIGNED,
    PRIMARY KEY (id),
    FOREIGN KEY (attribute_group) REFERENCES attribute_group (id) ON DELETE CASCADE,
    FOREIGN KEY (attribute) REFERENCES attribute (id) ON DELETE CASCADE
);

CREATE TABLE product_attribute (
    product INT UNSIGNED,
    attribute_group_attribute INT UNSIGNED,
    value VARCHAR (255),
    PRIMARY KEY (product, attribute_group_attribute),
    FOREIGN KEY (product) REFERENCES product (id) ON DELETE CASCADE,
    FOREIGN KEY (attribute_group_attribute) REFERENCES attribute_group_attribute (id) ON DELETE CASCADE
);

INSERT INTO
    product_type (code, name)
VALUES
    ("book", "Book"),
    ("dvd", "DVD"),
    ("furniture", "Furniture");

INSERT INTO
    product (sku, name, type, price, quantity, attribute_groups)
VALUES
    ("AAAAAAAA", "Book", 1, 1, 1, '[{"id":"1","code":"book-general","name":"General","description":"","display":"","attributes":[{"id":"1","code":"weight-kg","name":"Weight (kg)","type":"Number","metadata":"kg","value":"1"}]}]'),
    ("BBBBBBBB", "DVD", 2, 2, 2, '[{"id":"2","code":"dvd-general","name":"General","description":"","display":"","attributes":[{"id":"2","code":"size-mb","name":"Size (mb)","type":"Number","metadata":"mb","value":"2"}]}]'),
    ("CCCCCCCC", "Furniture", 3, 3, 3, '[{"id":"3","code":"dimensions","name":"Dimensions","description":"Please provide dimensions in WxHxL format.","display":"{1}x{2}x{3}","attributes":[{"id":"3","code":"width-cm","name":"Width (cm)","type":"Number","metadata":"cm","value":"3"},{"id":"4","code":"height-cm","name":"Height (cm)","type":"Number","metadata":"cm","value":"4"},{"id":"5","code":"length-cm","name":"Width (cm)","type":"Number","metadata":"cm","value":"5"}]}]');

INSERT INTO
    attribute (code, name, description, type, metadata)
VALUES
    ("weight-kg", "Weight (kg)", "", "number", "kg"),
    ("size-mb", "Size (mb)", "", "number", "mb"),
    ("width-cm", "Width (cm)", "", "number", "cm"),
    ("height-cm", "Height (cm)", "", "number", "cm"),
    ("length-cm", "Width (cm)", "", "number", "cm");

INSERT INTO
    attribute_group (code, name, description, display)
VALUES
    ("book-general", "General", "", ""),
    ("dvd-general", "General", "", ""),
    ("dimensions", "Dimensions", "Please provide dimensions in WxHxL format.", "{1}x{2}x{3}");

INSERT INTO
    product_type_attribute_group (product_type, attribute_group)
VALUES
    (1, 1),
    (2, 2),
    (3, 3);

INSERT INTO
    attribute_group_attribute (attribute_group, attribute)
VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (3, 4),
    (3, 5);

INSERT INTO
    product_attribute (product, attribute_group_attribute, value)
VALUES
    (1, 1, 1),
    (2, 2, 2),
    (3, 3, 3),
    (3, 4, 4),
    (3, 5, 5);
