# silverstripe-liquid-layout

Page/Controller that allows choosing an arbitrary template or layout for display.

As the current version bends the rules of SilverStripe's MVC conventions, it's recommended only as a tool for creating functional mockups w/ full templates before the models & controllers need to be built.

## Requirements

SilverStripe framework 3.0 +

SilverStripe CMS 3.0 +

## Maintainer Contact

* Craig Lyons (clyons@execproinc.com)

### Installation

Clone into a directory called liquid-layout, /dev/build.

### Usage

Create a LiquidLayout page in the CMS; the "Settings" tab will allow your choice of Template & Layout.

Standard file structure is assumed (themeDir/templates/ & themeDir/templates/Layout/).

If the module is able to source your directories, it will provide a dropdown list of all available .ss files as choices.  Otherwise, TextFields will be provided.

If a choice is not provided for Template or Layout, it will fall back on the respective Page.ss template or layout.

#### TODO

Provide a way to restrict choices to a subset or maybe a subdirectory via config.
This could then be a viable way to allow content authors to choose from a series of templates to present the same data.

