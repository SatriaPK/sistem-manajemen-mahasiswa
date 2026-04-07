# Tasks — Flutter Mahasiswa App

Implementation plan broken into phases. Complete each phase before moving to the next.

---

## Phase 1: Project Setup & Core Infrastructure

- [ ] 1. Create the Flutter project (`flutter create mahasiswa_app`)
- [ ] 2. Add all dependencies to `pubspec.yaml` (flutter_riverpod, dio, flutter_secure_storage, google_fonts, go_router, build_runner, riverpod_generator)
- [ ] 3. Create the folder structure: `lib/core/`, `lib/features/`, `lib/shared/`
- [ ] 4. Set up `app_colors.dart` and `app_text_styles.dart` with the retro/pixel color palette and Press Start 2P + JetBrains Mono fonts
- [ ] 5. Configure `app_theme.dart` using the colors and text styles, and apply it in `main.dart`
- [ ] 6. Create `token_storage.dart` wrapping `flutter_secure_storage` with `saveToken`, `getToken`, and `deleteToken` methods
- [ ] 7. Create `api_client.dart` setting up Dio with the base URL and default headers
- [ ] 8. Create `api_interceptor.dart` that attaches the Bearer token to every request and handles 401 responses by clearing the token and triggering a redirect to Login

---

## Phase 2: Laravel API Expansion

- [ ] 9. Add `POST /api/login` endpoint (validate email + password, return Sanctum token)
- [ ] 10. Add `POST /api/logout` endpoint (revoke the current Sanctum token)
- [ ] 11. Add `GET /api/dashboard` endpoint (return `totalMahasiswa`, `totalFakultas`, `totalProdi`, and the last 5 Mahasiswa with `prodi.fakultas`)
- [ ] 12. Add Fakultas API controller with: `index`, `store`, `show` (with prodis), `update`, `destroy`
- [ ] 13. Add Prodi API controller with: `index` (with fakultas), `store`, `update`, `destroy`
- [ ] 14. Add `GET /api/mahasiswa/{id}` endpoint (currently missing from the existing API)
- [ ] 15. Register all new API routes in `routes/api.php` and protect them with `auth:sanctum` middleware (except login)

---

## Phase 3: Authentication Feature

- [ ] 16. Create `AuthModel` (User + token) with `fromJson`
- [ ] 17. Create `AuthRepository` with `login(email, password)` and `logout()` methods
- [ ] 18. Create `AuthNotifier` (Riverpod `AsyncNotifier`) that manages auth state, persists the token on login, and clears it on logout
- [ ] 19. Build `LoginScreen`: app title, email field, password field, Login button, error message display
- [ ] 20. Wire the Login button to `AuthNotifier.login()` and navigate to Dashboard on success
- [ ] 21. On app launch (`main.dart`), check `token_storage` — if a token exists, initialize auth state and skip to Dashboard

---

## Phase 4: Navigation Shell

- [ ] 22. Configure `GoRouter` with routes: `/login`, `/dashboard`, `/mahasiswa`, `/mahasiswa/:id`, `/mahasiswa/create`, `/mahasiswa/:id/edit`, `/fakultas`, `/fakultas/:id`, `/fakultas/create`, `/fakultas/:id/edit`, `/prodi`, `/prodi/create`, `/prodi/:id/edit`
- [ ] 23. Add a GoRouter redirect guard: if auth state is unauthenticated, redirect any route to `/login`
- [ ] 24. Build `AppShell` with a `BottomNavigationBar` for Dashboard, Mahasiswa, Fakultas, and Prodi tabs

---

## Phase 5: Dashboard Feature

- [ ] 25. Create `DashboardStats` model with `fromJson`
- [ ] 26. Create `DashboardRepository` calling `GET /api/dashboard`
- [ ] 27. Create `DashboardNotifier` (Riverpod) that fetches and holds dashboard data
- [ ] 28. Build stat cards row (Total Mahasiswa, Total Fakultas, Total Prodi) using the `PixelCard` widget
- [ ] 29. Build the bar chart widget showing proportional bars for MHS / FAK / PRD
- [ ] 30. Build the "MAHASISWA TERBARU" section: 5 compact cards with a "VIEW ALL >" button that navigates to `/mahasiswa`
- [ ] 31. Assemble `DashboardScreen` with all widgets and connect to `DashboardNotifier`

---

## Phase 6: Shared Widgets

- [ ] 32. Build `PixelCard` widget (dark surface, 1px white border, padding)
- [ ] 33. Build `PixelButton` widget (square, bordered, uppercase text, primary/secondary variants)
- [ ] 34. Build `ConfirmDialog` widget (reusable delete confirmation with title, message, and Confirm/Cancel buttons)
- [ ] 35. Build `LoadingShimmer` widget (skeleton placeholder matching the list card layout)

---

## Phase 7: Mahasiswa Feature

- [ ] 36. Create `MahasiswaModel` with `fromJson` / `toJson`
- [ ] 37. Create `MahasiswaRepository` (index, show, store, update, destroy)
- [ ] 38. Create `MahasiswaNotifier` (Riverpod) managing list state and CRUD operations
- [ ] 39. Build `MahasiswaListScreen`: search bar, `ListView` of cards (Nama, NIM, Prodi), FAB for add, pull-to-refresh
- [ ] 40. Build `MahasiswaDetailScreen`: full info card (Nama, NIM, Prodi, Fakultas), Edit and Delete buttons
- [ ] 41. Build `MahasiswaFormScreen` (shared for Create and Edit): Nama field, NIM field, Prodi dropdown grouped by Fakultas, validation error display, SIMPAN button
- [ ] 42. Implement delete flow: show `ConfirmDialog` → call destroy → navigate back with success SnackBar

---

## Phase 8: Fakultas Feature

- [ ] 43. Create `FakultasModel` with `fromJson` / `toJson`
- [ ] 44. Create `FakultasRepository` (index, show, store, update, destroy)
- [ ] 45. Create `FakultasNotifier` (Riverpod)
- [ ] 46. Build `FakultasListScreen`: list of cards (Nama + Prodi count), FAB for add, pull-to-refresh
- [ ] 47. Build `FakultasDetailScreen`: Nama header, Prodi sub-list, Edit and Delete buttons
- [ ] 48. Build `FakultasFormScreen` (Create & Edit): single Nama field, SIMPAN button
- [ ] 49. Implement delete flow with `ConfirmDialog`

---

## Phase 9: Prodi Feature

- [ ] 50. Create `ProdiModel` with `fromJson` / `toJson`
- [ ] 51. Create `ProdiRepository` (index, store, update, destroy)
- [ ] 52. Create `ProdiNotifier` (Riverpod)
- [ ] 53. Build `ProdiListScreen`: list of cards (Nama + Fakultas name), FAB for add, pull-to-refresh
- [ ] 54. Build `ProdiFormScreen` (Create & Edit): Nama field, Fakultas dropdown, SIMPAN button
- [ ] 55. Implement delete flow with `ConfirmDialog`

---

## Phase 10: Polish & Error Handling

- [ ] 56. Apply `LoadingShimmer` on all list screens while data is loading
- [ ] 57. Show a `SnackBar` with a Retry action on network errors across all screens
- [ ] 58. Handle 401 globally via the Dio interceptor: clear token → GoRouter redirects to Login
- [ ] 59. Display field-level validation errors (422 responses) on all form screens
- [ ] 60. Add empty-state widgets (e.g., "NO DATA FOUND") for all list screens when results are empty
- [ ] 61. Test all CRUD flows on Android emulator
- [ ] 62. Test all CRUD flows on iOS simulator (if Mac available)
- [ ] 63. Verify the retro pixel aesthetic is consistent across all screens and screen sizes
