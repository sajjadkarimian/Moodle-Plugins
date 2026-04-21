## 📖 Project Context

This plugin was developed as part of a broader effort to improve **course navigation and data organization in Moodle-based learning environments**, particularly in scenarios where users are enrolled in a large number of courses across multiple categories.

In standard Moodle installations, the default *My courses* page presents courses in a flat or minimally structured format, which can become difficult to navigate at scale. This plugin addresses that limitation by introducing a structured, category-based view of enrolled courses.

The design of this plugin follows a **non-intrusive approach**, meaning:
- It does not override Moodle core pages
- It avoids fragile theme-dependent customizations
- It remains compatible with standard Moodle upgrade paths

This makes it suitable for use in production environments where **maintainability, portability, and reviewability** are important.

---

## 🎯 Purpose

The primary goal of this plugin is to:

- Improve usability of course navigation
- Provide a scalable way to organize enrolled courses
- Offer flexible presentation modes without modifying core behavior
- Serve as a clean, extensible foundation for further Moodle UI enhancements

---

## 🧩 Plugin Type

This is a **local plugin (`local_mycoursegroups`)**, meaning it:

- Adds new functionality without altering core Moodle behavior
- Can be safely installed or removed
- Is intended for site-specific enhancements and experimentation
