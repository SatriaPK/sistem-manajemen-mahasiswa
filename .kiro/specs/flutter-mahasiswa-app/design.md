# Design — Flutter Mahasiswa App

## Architecture

The app follows a **feature-first clean architecture**:

```
lib/
├── core/
│   ├── api/
│   │   ├── api_client.dart        # Dio HTTP client setup
│   │   └── api_interceptor.dart   # Auth token + 401 handling
│   ├── storage/
│   │   └── token_storage.dart     # flutter_secure_storage wrapper
│   └── theme/
│       ├── app_theme.dart         # ThemeData configuration
│       ├── app_colors.dart        # Color constants
│       └── app_text_styles.dart   # Typography (Press Start 2P, JetBrains Mono)
├── features/
│   ├── auth/
│   │   ├── data/
│   │   │   └── auth_repository.dart
│   │   ├── providers/
│   │   │   └── auth_provider.dart
│   │   └── screens/
│   │       └── login_screen.dart
│   ├── dashboard/
│   │   ├── data/
│   │   │   └── dashboard_repository.dart
│   │   ├── providers/
│   │   │   └── dashboard_provider.dart
│   │   └── screens/
│   │       └── dashboard_screen.dart
│   ├── mahasiswa/
│   │   ├── data/
│   │   │   ├── mahasiswa_model.dart
│   │   │   └── mahasiswa_repository.dart
│   │   ├── providers/
│   │   │   └── mahasiswa_provider.dart
│   │   └── screens/
│   │       ├── mahasiswa_list_screen.dart
│   │       ├── mahasiswa_detail_screen.dart
│   │       └── mahasiswa_form_screen.dart
│   ├── fakultas/
│   │   ├── data/
│   │   │   ├── fakultas_model.dart
│   │   │   └── fakultas_repository.dart
│   │   ├── providers/
│   │   │   └── fakultas_provider.dart
│   │   └── screens/
│   │       ├── fakultas_list_screen.dart
│   │       ├── fakultas_detail_screen.dart
│   │       └── fakultas_form_screen.dart
│   └── prodi/
│       ├── data/
│       │   ├── prodi_model.dart
│       │   └── prodi_repository.dart
│       ├── providers/
│       │   └── prodi_provider.dart
│       └── screens/
│           ├── prodi_list_screen.dart
│           └── prodi_form_screen.dart
├── shared/
│   └── widgets/
│       ├── pixel_card.dart        # Reusable bordered card widget
│       ├── pixel_button.dart      # Reusable retro-style button
│       ├── confirm_dialog.dart    # Delete confirmation dialog
│       └── loading_shimmer.dart   # Loading skeleton
└── main.dart
```

---

## State Management

- **Riverpod** (`flutter_riverpod`) for all state management.
- Each feature has an `AsyncNotifier` managing its state.
- Global auth state is provided at the root `ProviderScope`.
- API calls are wrapped in `AsyncValue` for loading/error/data states.

---

## Navigation

- **GoRouter** for declarative routing.
- A top-level redirect checks auth state: unauthenticated users are sent to `/login`.
- After login, users land on `/dashboard`.
- An `AppShell` widget wraps authenticated screens with a **Bottom Navigation Bar** (4 tabs):
  1. Dashboard
  2. Mahasiswa
  3. Fakultas
  4. Prodi
- Detail and form screens are pushed as sub-routes on top of their tab's navigator.

---

## API Integration

### Backend: Laravel + Sanctum

- **Base URL:** `http://<server-ip>/api`
- **Auth:** `Authorization: Bearer <token>` header on all protected requests.
- **Response format:**
  ```json
  {
    "success": true,
    "message": "...",
    "data": { ... }
  }
  ```

### Endpoints Required on Laravel

The existing API (`/api/mahasiswa`) must be expanded. All routes below must be protected with `auth:sanctum` middleware, except login.

| Method   | Endpoint                 | Description                              |
|----------|--------------------------|------------------------------------------|
| POST     | `/api/login`             | Authenticate, return Sanctum token       |
| POST     | `/api/logout`            | Revoke current token                     |
| GET      | `/api/dashboard`         | Return stats + last 5 Mahasiswa          |
| GET      | `/api/mahasiswa`         | List all Mahasiswa (with prodi.fakultas) |
| POST     | `/api/mahasiswa`         | Create Mahasiswa                         |
| GET      | `/api/mahasiswa/{id}`    | Get single Mahasiswa detail *(new)*      |
| PUT      | `/api/mahasiswa/{id}`    | Update Mahasiswa                         |
| DELETE   | `/api/mahasiswa/{id}`    | Delete Mahasiswa                         |
| GET      | `/api/fakultas`          | List all Fakultas (with prodi count)     |
| POST     | `/api/fakultas`          | Create Fakultas                          |
| GET      | `/api/fakultas/{id}`     | Get Fakultas detail (with Prodi list)    |
| PUT      | `/api/fakultas/{id}`     | Update Fakultas                          |
| DELETE   | `/api/fakultas/{id}`     | Delete Fakultas                          |
| GET      | `/api/prodi`             | List all Prodi (with fakultas name)      |
| POST     | `/api/prodi`             | Create Prodi                             |
| PUT      | `/api/prodi/{id}`        | Update Prodi                             |
| DELETE   | `/api/prodi/{id}`        | Delete Prodi                             |

---

## Data Models

```dart
// lib/features/auth/data/auth_model.dart
class UserModel {
  final int id;
  final String name;
  final String email;
  final String token; // Sanctum plain-text token
}

// lib/features/fakultas/data/fakultas_model.dart
class FakultasModel {
  final int id;
  final String nama;
  final int? prodiCount;
  final List<ProdiModel>? prodis;
}

// lib/features/prodi/data/prodi_model.dart
class ProdiModel {
  final int id;
  final String nama;
  final int fakultasId;
  final FakultasModel? fakultas;
}

// lib/features/mahasiswa/data/mahasiswa_model.dart
class MahasiswaModel {
  final int id;
  final String nama;
  final String nim;
  final int prodiId;
  final ProdiModel? prodi;
}

// lib/features/dashboard/data/dashboard_model.dart
class DashboardStats {
  final int totalMahasiswa;
  final int totalFakultas;
  final int totalProdi;
  final List<MahasiswaModel> recentMahasiswa;
}
```

---

## UI Design

### Theme

| Property        | Value                                             |
|-----------------|---------------------------------------------------|
| Background      | `#1A1A1A` (near-black)                            |
| Surface (cards) | `#222222` with `1px` white border                 |
| Primary text    | `#F0F0F0`                                         |
| Secondary text  | `#888888`                                         |
| Muted text      | `#555555`                                         |
| Accent          | `#FFFFFF`                                         |
| Font (headings) | **Press Start 2P** (via `google_fonts`)           |
| Font (body)     | **JetBrains Mono** (via `google_fonts`)           |
| Button style    | Square, no border-radius, 1px border, uppercase   |

### Screen Designs

#### Login Screen
- Full-screen dark background.
- Centered column: app title in Press Start 2P, email field, password field, Login button.
- Error message displayed below the button in red monospace text.

#### Dashboard Screen
- Horizontal scroll row of 3 stat cards (Total Mahasiswa, Fakultas, Prodi) — each shows label + large number.
- Bar chart widget: 3 bars proportional to the counts, labeled MHS / FAK / PRD.
- "MAHASISWA TERBARU" section: a `ListView` of 5 compact cards, each showing name, NIM, Prodi. "VIEW ALL >" button at the top-right navigates to the Mahasiswa list.

#### Mahasiswa List Screen
- Search bar at the top (filters by name/NIM).
- `ListView` of cards: each card shows Nama (primary), NIM (secondary, muted color), Prodi name.
- FAB (Floating Action Button) with "+" to navigate to the create form.
- Pull-to-refresh supported.

#### Mahasiswa Detail Screen
- Full card with rows: Nama, NIM, Prodi, Fakultas.
- Two action buttons at the bottom: **EDIT** and **DELETE**.

#### Mahasiswa Form Screen (Create & Edit)
- Text fields: Nama, NIM.
- Dropdown for Prodi: items grouped by Fakultas header.
- Submit button: **SIMPAN**.
- Validation errors shown below each field.

#### Fakultas List Screen
- `ListView` of cards: each shows Nama + "X PRODI" count.
- FAB for add.

#### Fakultas Detail Screen
- Nama displayed as header.
- Sub-list of Prodi belonging to this Fakultas.
- **EDIT** and **DELETE** buttons.

#### Fakultas Form Screen
- Single text field: Nama.
- Submit button.

#### Prodi List Screen
- `ListView` of cards: each shows Nama + Fakultas name.
- FAB for add.

#### Prodi Form Screen (Create & Edit)
- Text field: Nama.
- Dropdown: Fakultas.
- Submit button.

---

## Error Handling

| Scenario              | Behavior                                                   |
|-----------------------|------------------------------------------------------------|
| Network error         | SnackBar: "Koneksi gagal. Coba lagi." with Retry action   |
| 401 Unauthorized      | Clear token → redirect to Login screen                     |
| 422 Validation error  | Display field-level error messages below each input        |
| 404 Not Found         | Show "Data tidak ditemukan" message on screen              |
| Loading state         | Show shimmer skeleton or `CircularProgressIndicator`       |

---

## Dependencies (`pubspec.yaml`)

```yaml
dependencies:
  flutter_riverpod: ^2.6.1
  riverpod_annotation: ^2.3.5
  dio: ^5.7.0
  flutter_secure_storage: ^9.2.2
  google_fonts: ^6.2.1
  go_router: ^14.2.7

dev_dependencies:
  build_runner: ^2.4.12
  riverpod_generator: ^2.4.3
```
