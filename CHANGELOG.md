# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

- Nothing right now. [Open an issue](https://github.com/WildCodeSchool/symfony-projet3-starter-kit/issues) if you find something.

## [7.4.0] - 2025-07-12

### Changed
- Update to Symfony 7.4.
- Migrate PHPStan config from 1.5 to 2.1.
- Run quality check on dev and staging, instead of dev and main: use main for deploy only.

### Removed
- Remove Sass support.
- Remove PHPCPD (no longer maintained).

## [1.0.2] - 2024-05-23

### Added
- AssetMapper with SymfonyCats/SassBundle to compile SCSS files to CSS files.

### Removed
- Remove Webpack Encore and all related files (yarn, npm…).

## [1.0.1] - 2023-12-04

### Added
- Add CHANGELOG.md file.

### Updated
- Update README.md with CHANGELOG link.
- Update to Symfony 6.4.1 

### Removed
- ESLint from list of Grumphp tools cause bugs with Stimulus controllers. Need to be replaced.
