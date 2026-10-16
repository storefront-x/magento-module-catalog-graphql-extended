## [1.0.0] - 2022-09-20
### Added
- created new module.

### [1.0.1]
### Added
- extension of Cart type in GQL schema to return child skus on AddConfigurableProductToCart method

### [1.0.2] - 2022-12-20
### Added
- select product attribute by product ID

### [1.0.3] - 2022-12-20
### Added
- Enable product fragment to graphql

### [1.0.4] - 2023-02-05
### Added
- Change image url to absolute in dynamic block

### [1.0.9] - 2023-03-06
### Added
- Cache identity to schema graqhqls
- Change image url to media URL in dynamic block

## [Unreleased]
### Fixed
- PHP 8.4/8.5 compatibility: explicit nullable types for parameters with a null default (implicitly nullable parameters are deprecated since PHP 8.4).

## [Unreleased]
### Fixed
- search_request.xml: removed the empty <aggregations> element, which fails XSD validation in developer mode ("Expected is ( bucket )").
