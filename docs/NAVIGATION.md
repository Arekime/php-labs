# Project Navigation Structure

## Site Map

```text
                                    +------------------+
                                    |    index.php     |
                                    |  (Select Variant)|
                                    +--------+---------+
                                             |
                                             v
                                    +------------------+
                                    |  Variant Page    |
                                    | /lr1/variants/v1 |
                                    |    index.php     |
                                    +--------+---------+
                                             |
              +------------------------------+------------------------------+
              |                              |                              |
              v                              v                              v
        +-----------+               +--------------+               +--------------+
        |   Demo    |               |   Task 2     |               |   Task N     |
        +-----------+               +--------------+               +--------------+
              |
              v
        Demo Tasks
        (accessible only
        from variant page)
```

## URL Structure

```text
/                                    -> Home page (variant selection only)
/lr1/variants/v1/index.php           -> Variant page (task cards + demo)
/lr1/variants/v1/task3.php           -> Variant task
/lr1/demo/index.php?from=v1          -> Demo index (from variant only)
/lr1/demo/task3.php?from=v1          -> Demo task (from variant only)
```

## Navigation Flow

```text
                    Home Page (/)
                  [Select Variant]
                         |
                         v
               Variant Page (index.php)
            [Demo] [2] [3] [4] [5] [6] [7]
                  /     |           \
                 /      |            \
                v       v             v
           Demo      Task 2  ...   Task N
           Index     Page          Page
              |         |             |
              v         |             |
         Demo Tasks     |             |
              |         |             |
              +---------+-------------+
                        |
                        v
              [Back to Variant]
```

## Page Types

### 1. Home Page (`/index.php`)

Simple variant selection. After selecting → redirect to variant page.

```text
+--------------------------------------------------+
|                    PHP Labs                       |
|                                                  |
|          Variant: [v1 ▼]  [ Select ]            |
|                                                  |
+--------------------------------------------------+
```

### 2. Variant Page (`/lr1/variants/v1/index.php`)

Main working page. Shows task cards with Demo as first card.

```text
+--------------------------------------------------+
|  [Home]                            Variant 1     |
+--------------------------------------------------+

     +------+  +---+  +---+  +---+  +---+  +---+
     | Demo |  | 2 |  | 3 |  | 4 |  | 5 |  | 6 |
     +------+  +---+  +---+  +---+  +---+  +---+

               +-----+  +-----+
               | 7.1 |  | 7.2 |
               +-----+  +-----+
```

### 3. Variant Task Page (`/lr1/variants/v1/task3.php`)

Task page with navigation to demo.

```text
+------------------------------------------------------------------+
|  [Home] [← Variant] [Demo]  |  ❌ 0%  |  Variant 1 / Task 3      |
+------------------------------------------------------------------+

+------------------------------------------------------------------+
|                        Task Content                              |
|                    (student implements)                          |
+------------------------------------------------------------------+
```

### 4. Demo Index (`/lr1/demo/index.php?from=v1`)

Demo overview. Only accessible from variant page (has `?from=v1`).

```text
+--------------------------------------------------+
|  [Home] [← Variant 1]                    Demo    |
+--------------------------------------------------+

        +---+  +---+  +---+  +---+  +---+
        | 2 |  | 3 |  | 4 |  | 5 |  | 6 |
        +---+  +---+  +---+  +---+  +---+

               +-----+  +-----+
               | 7.1 |  | 7.2 |
               +-----+  +-----+
```

### 5. Demo Task Page (`/lr1/demo/task3.php?from=v1`)

Demo solution. Shows "Back to Variant" button.

```text
+------------------------------------------------------------------+
|  [Home] [← Demo] [← Variant 1]  |  ✅ 100%  |  Demo / Task 3     |
+------------------------------------------------------------------+

+------------------------------------------------------------------+
|                        Demo Content                              |
|                    (completed example)                           |
+------------------------------------------------------------------+
```

## Navigation Buttons

| Button | Description | Appears On |
|--------|-------------|------------|
| `[Home]` | Back to home `/` | All pages |
| `[← Variant]` | Back to variant index | Variant task pages |
| `[Demo]` | Open demo for this task | Variant task pages |
| `[← Variant N]` | Back to variant | Demo pages |
| `[← Demo]` | Back to demo index | Demo task pages |

## Key Principles

1. **Variant-centric**: Student selects variant once, works within it
2. **Demo from variant only**: Demo is accessed through variant page
3. **Easy return**: Always can return to variant from demo
4. **Context preserved**: `?from=vN` parameter tracks origin variant

## Button Styles

| Type | Background | Text | Purpose |
|------|------------|------|---------|
| Default | `#f1f5f9` | `#374151` | Home, Back |
| Demo | `#e0e7ff` | `#4f46e5` | Link to demo |
| Variant | `#d1fae5` | `#065f46` | Return to variant |

## Student Workflow

1. Open `/` → Select variant (e.g., v1)
2. Arrive at variant page `/lr1/variants/v1/index.php`
3. See task cards: `[Demo] [2] [3] [4] [5] [6] [7.1] [7.2]`
4. Click task (e.g., "3") → `/lr1/variants/v1/task3.php`
5. See test status (❌ not implemented)
6. Click `[Demo]` → `/lr1/demo/task3.php?from=v1`
7. Study demo solution
8. Click `[← Variant 1]` → back to variant task
9. Implement solution, refresh, see ✅
10. Click `[Home]` → back to home (select variant again)

## File Structure

```text
php-labs/
├── index.php                      # Home (variant selection)
│
├── lr1/
│   ├── demo/
│   │   ├── index.php             # Demo index (?from=vN)
│   │   ├── layout.php            # Demo layout
│   │   └── task*.php             # Demo tasks
│   │
│   └── variants/
│       ├── shared/
│       │   ├── layout.php        # Variant layout
│       │   └── style.css
│       │
│       └── v1/
│           ├── index.php         # Variant page (task cards)
│           ├── config.php
│           └── task*.php         # Variant tasks
```

## URL Parameters

| Parameter | Values | Purpose |
|-----------|--------|---------|
| `variant` | `v1`...`v15` | Selected variant (home page) |
| `from` | `v1`...`v15` | Origin variant (demo pages) |
