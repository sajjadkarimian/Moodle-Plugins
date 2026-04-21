# Courses by category (`local_mycoursegroups`)

An alternative Moodle page that displays a user's enrolled courses grouped by course category in Boost theme.

## What this plugin does

- Groups a user's enrolled courses by their course category.
- Offers two presentation modes: **Card** and **List**.
- Uses course overview images when available.
- Lets administrators configure the default view and summary display.
- Does **not** replace Moodle core pages automatically.

## Why this version is safer to publish

This package avoids fragile site-specific hacks such as:

- overriding core navigation items with CSS,
- forcing redirects from `/my/courses.php`,
- depending on theme-specific DOM structure.

That makes it easier to review, install, and maintain across Moodle upgrades.

## Installation

1. Copy the plugin folder to:
   `local/mycoursegroups`
2. Visit **Site administration > Notifications**.
3. Complete the installation.
4. Configure the plugin at:
   **Site administration > Plugins > Local plugins > Courses by category**

## Usage

Open:

`/local/mycoursegroups/index.php`

You can also add a site navigation link manually through theme settings or a custom menu.

## Configuration

Available settings:

- Default view: card or list
- Show or hide course summary
- Summary length
- Show or hide category headings

## Compatibility

- Moodle 4.0+
- Intended for Boost-based themes and standard Moodle installations

## Privacy

This plugin does not store personal data.

## Limitations

- It does not replace the standard **My courses** page automatically.
- Navigation replacement should be handled separately by theme or site configuration if required.

## License

GNU GPL v3 or later.
