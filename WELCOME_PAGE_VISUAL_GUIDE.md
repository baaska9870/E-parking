# Welcome Page Visual Guide

## Page Layout After Enhancements

### Desktop View (Logged Out)

```
┌──────────────────────────────────────────────────────────────┐
│  🅿️ E-Parking  │  [🔐 Нэвтрэх] [✨ Бүртгүүлэх]             │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│         Зогсоол хайх хялбар боллоо                          │
│         [======== SEARCH BOX ========]                      │
│                                                              │
├──────────────────────────────────────────────────────────────┤
│  📍 Газ │ 🚗 Зогс │ ℹ️ Мэдээл                               │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│                    ┌─────────────────────┐                  │
│              📍 Байршил унших ... [●]   │                  │
│                    └─────────────────────┘  ← Status        │
│                                              Indicator      │
│  ┌──────────────────────────────────────┐                  │
│  │           🗺️  MAP VIEW               │                  │
│  │                                       │                  │
│  │  • P (Green) - Parking Markers       │                  │
│  │  • 🔵 - User Location (Blue)         │                  │
│  │  • ⭕ - Accuracy Circle (Dashed)     │                  │
│  │                                       │                  │
│  └──────────────────────────────────────┘                  │
│                                                              │
│                                      ┌────┐                 │
│                                      │🔐  │ ← Floating      │
│                                      │    │   Login Button  │
│                                      └────┘                 │
└──────────────────────────────────────────────────────────────┘
```

### Desktop View (Logged In)

```
┌──────────────────────────────────────────────────────────────┐
│  🅿️ E-Parking  │  [J] John  [📊 Dashboard] [Гарах]         │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│         Зогсоол хайх хялбар боллоо                          │
│         [======== SEARCH BOX ========]                      │
│                                                              │
├──────────────────────────────────────────────────────────────┤
│  📍 Газ │ 🚗 Зогс │ ℹ️ Мэдээл                               │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│                    ┌─────────────────────┐                  │
│              ✓ Байршил илрүүлэгдсэн     │ ← Green Status   │
│                    └─────────────────────┘                  │
│                                                              │
│  ┌──────────────────────────────────────┐                  │
│  │           🗺️  MAP VIEW               │                  │
│  │                                       │                  │
│  │  • P (Green) - Parking Markers       │                  │
│  │  • 🔵 - Your Location (Blue)         │                  │
│  │  • ⭕ - Accuracy Circle (Dashed)     │                  │
│  │                                       │                  │
│  └──────────────────────────────────────┘                  │
│                                                              │
│             (No Floating Button - User Logged In)          │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

---

## Map Area (Zoomed In)

### Location Tracking Visualization

```
Map with Parking and User Location:

    P (Green)         P (Red)
     ┌─────────────────────────┐
     │  📍 Parking 1           │
     │  P (Yellow)              │
     │                          │
     │    🔵 ← User Location    │
     │   ⭕ (Blue dot)           │  ← Accuracy Circle
     │  ⭕⭕                     │     (Semi-transparent)
     │ ⭕⭕⭕P (Green)          │
     │  ⭕⭕                     │
     │                          │
     │      P (Orange)          │
     └─────────────────────────┘

User Clicks Blue Marker:
    ┌─────────────────────┐
    │ 📍 Таны байршил    │
    │                     │
    │ Зочих: 47.9184   │
    │ Урт: 106.9177   │
    │                     │
    │      [Close ✕]      │
    └─────────────────────┘
```

---

## Floating Login Button Animation

### Resting State (60x60px)

```
Bottom-Right Corner:
┌────────────────┐
│                │ 30px gap
│                │
│              ┌─┐
│              │🔐│ ← 60x60px
│              └─┘
│                 30px gap
└────────────────┘
```

### Hover State (Expanded)

```
Bottom-Right Corner:
┌────────────────┐
│                │ 
│    [🔐 Нэвтрэх]
│                │
│                 
└────────────────┘

Button expands to show:
• Text: "Нэвтрэх" (Login)
• Background: Still gradient
• Animation: Smooth scale
• Shadow: Intensifies
```

### Visual Feedback

```
Normal:            Hover:              Clicked:
┌────┐            ┌─────────┐         Redirect
│🔐  │  →hover→  │🔐 Nэвтэх│  →click  to /login
└────┘            └─────────┘
Subtle              Glowing           Navigation
Shadow             Shadow
```

---

## Location Status Indicator States

### State 1: Initial (Loading)

```
Position: Top-right of map
┌──────────────────────────┐
│ 📍 Байршил унших ... [●] │
│    (pulsing dot)         │
└──────────────────────────┘

Animation: Dot pulses 2-second cycle
Color: Dark gray text, white background
```

### State 2: Success

```
Position: Top-right of map
┌──────────────────────────╴┐
│ ✓ Байршил илрүүлэгдсэн   │
│    (green text - success) │
└──────────────────────────╴┘

Animation: Stable (no pulse)
Color: Green (#16a34a)
```

### State 3: Error/Denied

```
Position: Top-right of map
┌──────────────────────────┐
│ 📍 Байршил унших боломжгүй│
│    (red text - error)    │
└──────────────────────────┘

Animation: Stable (no pulse)
Color: Red (#ef4444)
User needs to enable location
```

---

## Mobile Layout

### Mobile View (Logged Out)

```
┌──────────────────────────────┐
│  🅿️ E-Parking       [☰]     │
├──────────────────────────────┤
│   [Нэвтрэх] [Бүртгүүлэх]    │
│                              │
│     Зогсоол хайх хялбал     │
│   [======SEARCH======]      │
│                              │
├──────────────────────────────┤
│ 📍Газ │ 🚗Зогс │ ℹ️Мэдээл  │
├──────────────────────────────┤
│                              │
│ ┌──────────────────────────┐ │
│ │ ✓ Байршил илрүүлгдсэн  │ │ ← Status
│ │                          │ │
│ │       🗺️ MAP            │ │
│ │                          │ │
│ │    🔵 (user location)   │ │
│ │    P P P (parking)      │ │
│ │                          │ │
│ │                          │ │
│ └──────────────────────────┘ │
│                              │
│                    ┌──┐      │
│                    │🔐│ ← Floating Button
│                    └──┘      │
│                    (Fixed)   │
└──────────────────────────────┘
```

### Mobile View (Logged In)

```
┌──────────────────────────────┐
│ 🅿️ E-Parking  [J]  [☰]      │
├──────────────────────────────┤
│   Зогсоол хайх хялбал       │
│   [======SEARCH======]      │
│                              │
├──────────────────────────────┤
│ 📍Газ │ 🚗Зогс │ ℹ️Мэдээл  │
├──────────────────────────────┤
│                              │
│ ┌──────────────────────────┐ │
│ │ ✓ Байршил илрүүлгдсэн  │ │
│ │                          │ │
│ │       🗺️ MAP            │ │
│ │                          │ │
│ │    🔵 (user location)   │ │
│ │    P P P (parking)      │ │
│ │                          │ │
│ │                          │ │
│ └──────────────────────────┘ │
│                              │
│  (No Floating Button)        │
└──────────────────────────────┘

Menu (after clicking ☰):
┌──────────────────────────┐
│ Dashboard                │
│ Profile                  │
│ Settings                 │
│ Logout                   │
└──────────────────────────┘
```

---

## Color Legend

### Map Markers
```
P (Green)    = 40-100% Available (Πольно свободно)
P (Yellow)   = 40% Available (Среднее)
P (Orange)   = 10-40% Available (Мало)
P (Red)      = < 10% Available (Переполнено)

🔵 (Blue)    = Your Current Location
⭕ (Dashed)  = Accuracy Radius
```

### Status Indicator
```
Gray          = Initial/Loading
Green #16a34a = Success (Location Found)
Red #ef4444   = Error (Permission Denied)
```

### Buttons
```
Purple Gradient = Primary Actions (Login, Buttons)
Gray            = Secondary Actions
Blue            = Search/Action
```

---

## User Interactions

### Scenario 1: Guest User Landing

```
1. User arrives at home page
        ↓
2. Browser asks for location permission
        ↓
3. User clicks "Allow"
        ↓
4. Blue marker appears (their location)
        ↓
5. Status changes: "📍 Байршил унших ..." → 
                   "✓ Байршил илрүүлэгдсэн"
        ↓
6. User sees floating login button
   (bottom-right corner)
        ↓
7. User hovers over button
   Button expands: "🔐 Нэвтрэх"
        ↓
8. User clicks button
   → Redirected to /login
```

### Scenario 2: Logged-In User Viewing

```
1. User is already logged in
   (checked via Auth::check())
        ↓
2. User visits home page
        ↓
3. Map loads with location tracking
        ↓
4. Blue marker shows their location ✓
        ↓
5. Status indicator shows ✓ 
   (green - success)
        ↓
6. Floating button is HIDDEN
   (not shown because user is logged in)
        ↓
7. User can access dashboard
   from header button: [📊 Dashboard]
```

### Scenario 3: Permission Denied

```
1. User clicks "Don't Allow" or "Block"
   on geolocation prompt
        ↓
2. Browser denies location access
        ↓
3. Blue marker does NOT appear
        ↓
4. Status indicator shows ERROR
   (red text): "📍 Байршил унших боломжгүй"
        ↓
5. Map still works with default location
   (center on Ulaanbaatar)
        ↓
6. Parking markers still visible
        ↓
7. User can still use app normally
   (just without personal location)
```

---

## Animation Timings

### Button Hover Animation
```
Duration:      0.3 seconds
Easing:        ease
Transform:     scale(1.1)
Shadow Glow:   Intensifies
```

### Status Dot Pulse
```
Duration:      2 seconds (full cycle)
Easing:        Linear
0% - 50%       opacity: 1
50% - 100%     opacity: 0.5
Repeat:        Infinite
```

### Map Location Update
```
Location Found:    ~1-3 seconds
Marker Fade-In:    0.5 seconds
Circle Draw:       0.3 seconds
Status Update:     ~2 seconds
```

---

## Responsive Breakpoints

### Desktop (>1024px)
```
✓ Full-width map
✓ Side-by-side layout
✓ Large buttons
✓ Expanded menus
```

### Tablet (768px - 1024px)
```
✓ Adjusted map size
✓ Stack layout
✓ Medium buttons
✓ Adaptive spacing
```

### Mobile (<768px)
```
✓ Full-width content
✓ Vertical layout
✓ Touch-friendly buttons
✓ Compressed navigation
```

### Small Mobile (<400px)
```
✓ Single-column layout
✓ Stacked map/content
✓ Large touch targets
✓ Icons + minimal text
```

---

## Accessibility Features

### Keyboard Navigation
```
Tab:     Cycle through interactive elements
Enter:   Activate buttons
Space:   Toggle checkboxes
Esc:     Close popups/modals
```

### Screen Reader Support
```
✓ Semantic HTML
✓ ARIA labels on buttons
✓ Status announcements
✓ Form labels
```

### Visual Accessibility
```
✓ High contrast colors
✓ Clear text labels
✓ Visible focus states
✓ Large touch targets
```

---

**Status**: ✅ All Enhancements Complete
**Version**: 1.0
**Date**: March 25, 2026
