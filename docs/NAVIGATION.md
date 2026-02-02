# Project Navigation Structure

## Site Map

```text
                                    +------------------+
                                    |    index.php     |
                                    |   (Home Page)    |
                                    +--------+---------+
                                             |
              +------------------------------+------------------------------+
              |                              |                              |
              v                              v                              v
    +-----------------+            +-----------------+            +-----------------+
    |      LR1        |            |      LR2        |            |     LR3...      |
    +-----------------+            +-----------------+            +-----------------+
              |
              v
    +-------------------+
    |  Variant Index    |
    |  /lr1/variants/   |
    |  v1/index.php     |
    +-------------------+
              |
              +---> Task Cards [Demo] [2] [3] [4] [5] [6] [7.1] [7.2]
                         |       |    |    |    |    |     |      |
                         |       +----+----+----+----+-----+------+
                         |                   |
                         v                   v
                   /lr1/demo/          /lr1/variants/v1/
                   index.php           task{N}.php
```

## URL Structure

```text
/                                    -> Home page (lab selection)
/lr1/demo/index.php                  -> Demo index (task cards, NO demo link)
/lr1/demo/task2.php                  -> Demo task 2
/lr1/variants/v1/index.php           -> Variant 1 index (task cards + demo link)
/lr1/variants/v1/task2.php           -> Variant 1, task 2
```

## Page Types

### 1. Home Page (`/index.php`)

```text
+--------------------------------------------------+
|                    PHP Labs                       |
|                                                  |
|     +--------+    +--------+    +--------+       |
|     |  LR1   |    |  LR2   |    |  LR3   |       |
|     +--------+    +--------+    +--------+       |
|                                                  |
+--------------------------------------------------+
```

### 2. Variant Index Page (`/lr1/variants/v1/index.php`)

Compact header fixed to top. Task cards with numbers. First card = Demo.

```text
+--------------------------------------------------+ <- fixed top
|  [Home]                            Варіант 1     |
+--------------------------------------------------+

     +------+  +---+  +---+  +---+  +---+  +---+
     | Demo |  | 2 |  | 3 |  | 4 |  | 5 |  | 6 |
     +------+  +---+  +---+  +---+  +---+  +---+

               +-----+  +-----+
               | 7.1 |  | 7.2 |
               +-----+  +-----+
```

### 3. Demo Index Page (`/lr1/demo/index.php`)

Same structure, NO "Demo" card (this IS the demo).

```text
+--------------------------------------------------+ <- fixed top
|  [Home]                                Демо      |
+--------------------------------------------------+

        +---+  +---+  +---+  +---+  +---+
        | 2 |  | 3 |  | 4 |  | 5 |  | 6 |
        +---+  +---+  +---+  +---+  +---+

               +-----+  +-----+
               | 7.1 |  | 7.2 |
               +-----+  +-----+
```

### 4. Task Page (both Demo and Variant)

Header fixed to top, compact size, includes test status.

**Variant task (initial state - not implemented):**
```text
+------------------------------------------------------------------+ <- fixed top
|  [Home] [Back]  |  ❌ Не виконано 0/6 0%  |  Варіант 1 / Завд. 3 |
+------------------------------------------------------------------+
```

**Variant task (after student completes):**
```text
+------------------------------------------------------------------+ <- fixed top
|  [Home] [Back]  |  ✅ Виконано 6/6 100%   |  Варіант 1 / Завд. 3 |
+------------------------------------------------------------------+
```

**Demo task (always completed):**
```text
+------------------------------------------------------------------+ <- fixed top
|  [Home] [Back]  |  ✅ Виконано 6/6 100%   |  Демо / Завд. 3      |
+------------------------------------------------------------------+
```

```text
+------------------------------------------------------------------+
|                                                                  |
|                        Task Content                              |
|                                                                  |
+------------------------------------------------------------------+
```

**Header elements (left to right):**
- `[Home]` - go to home page
- `[Back]` - go back to index
- Test status: icon + short text + score + percentage
- Context: Variant/Demo + Task number

**Test status states:**
- `❌ Не виконано 0/6 0%` - initial state (student variants)
- `⚠️ Частково 3/6 50%` - some tests pass
- `✅ Виконано 6/6 100%` - all tests pass (demo, completed variants)

## Task Card Design

Standardized across the project:

```text
+-------+
|       |
|   2   |    <- Just number (or "Demo" for demo link)
|       |
+-------+

States:
- Default: light background
- Hover: shadow + scale
- Active/Current: highlighted border
```

## Navigation Flow

```text
                    Home Page (/)
                         |
         +---------------+---------------+
         |                               |
         v                               v
   Variant Index                    Demo Index
   /lr1/variants/v1/               /lr1/demo/
   index.php                       index.php
         |                               |
         |  [Demo] ------------------>   |
         |                               |
    [2][3][4][5][6][7.1][7.2]      [2][3][4][5][6][7.1][7.2]
         |                               |
         v                               v
   Variant Tasks                    Demo Tasks
   /lr1/variants/v1/task{N}.php    /lr1/demo/task{N}.php
```

## File Architecture

```text
php-labs/
├── index.php                      # Home page
├── shared/                        # GLOBAL shared (all labs)
│   ├── css/
│   │   └── base.css              # Base styles + task cards
│   ├── helpers/
│   │   └── test_helper.php       # Test functions
│   └── templates/
│       └── task_cards.php        # Shared task cards component
│
├── lr1/                           # Lab 1
│   ├── demo/
│   │   ├── index.php             # Demo index (cards, NO demo link)
│   │   ├── demo.css
│   │   └── task*.php
│   │
│   └── variants/
│       ├── shared/
│       │   ├── layout.php        # Layout with nav
│       │   ├── index_layout.php  # Index page layout (cards)
│       │   └── style.css
│       │
│       └── v1/
│           ├── index.php         # Variant index (cards + demo link)
│           ├── config.php
│           └── task*.php
```

## Header Design

**All pages:** Fixed to top, compact height (~50px).

```text
+------------------------------------------------------------------+
|  [Nav buttons]  |  [Status (task only)]  |  [Title/Variant]      |
+------------------------------------------------------------------+
```

## Navigation Elements

| Element | Variant Index | Demo Index | Task Page |
|---------|---------------|------------|-----------|
| Home button | ✅ | ✅ | ✅ |
| Back button | ❌ | ❌ | ✅ |
| Test status (in header) | ❌ | ❌ | ✅ |
| Title | "Варіант N" | "Демо" | "Варіант N / Завд. X" |
| Demo card | ✅ | ❌ | - |
| Task cards | ✅ | ✅ | - |

## Card Component

Reusable across all labs:

```php
<?php
// shared/templates/task_cards.php
function renderTaskCards(array $tasks, bool $showDemo = true, string $demoUrl = ''): string
{
    $html = '<div class="task-cards">';

    if ($showDemo && $demoUrl) {
        $html .= '<a href="' . $demoUrl . '" class="task-card task-card-demo">Demo</a>';
    }

    foreach ($tasks as $num => $task) {
        $html .= '<a href="' . $task['url'] . '" class="task-card">' . $num . '</a>';
    }

    $html .= '</div>';
    return $html;
}
```

## Test Status Indicators

| Status | Icon | Color | Meaning |
|--------|------|-------|---------|
| Passed | ✅ | Green | All tests pass |
| Partial | ⚠️ | Yellow | Some tests pass |
| Not Implemented | ❌ | Red | No tests pass |
| No Tests | ❓ | Gray | Tests not found |

## Quick Reference

### For Students

1. Open variant: `/lr1/variants/vN/index.php`
2. See task cards with numbers
3. Click card to open task
4. Check test status (red = not done)
5. Edit `tasks/taskN.php`
6. Refresh to see results

### For Instructors

1. Demo: `/lr1/demo/index.php`
2. Same card interface as students
3. Validate: `php lr1/validate_lab.php`
