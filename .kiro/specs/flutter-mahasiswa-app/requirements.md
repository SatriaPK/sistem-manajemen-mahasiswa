# Requirements — Flutter Mahasiswa App

## Overview

Mobile application for **Sistem Manajemen Mahasiswa**, built with Flutter. The app consumes the Laravel backend REST API and shares the same database as the web version. The UI adapts the retro/pixel aesthetic of the web app into a mobile-friendly interface.

---

## 1. Authentication

**User Stories:**
- As a user, I want to log in with my email and password so that I can access the system securely.
- As a user, I want to remain logged in between app sessions so that I don't have to log in every time.
- As a user, I want to log out so that I can end my session securely.

**Acceptance Criteria:**
- WHEN a user enters valid credentials and taps Login, THE SYSTEM SHALL authenticate via the Laravel Sanctum API and store the returned token locally.
- WHEN a user enters invalid credentials, THE SYSTEM SHALL display an error message below the form.
- WHEN a stored auth token exists on app launch, THE SYSTEM SHALL skip the login screen and navigate directly to the Dashboard.
- WHEN a user taps Logout, THE SYSTEM SHALL revoke the token on the server and redirect to the Login screen.
- WHEN an API request returns 401 Unauthorized, THE SYSTEM SHALL clear the stored token and redirect to Login.

---

## 2. Dashboard

**User Stories:**
- As a user, I want to see a system overview when I open the app so that I can quickly assess the current data state.

**Acceptance Criteria:**
- WHEN the Dashboard screen loads, THE SYSTEM SHALL display the total count of Mahasiswa, Fakultas, and Prodi as stat cards.
- WHEN the Dashboard screen loads, THE SYSTEM SHALL display a visual bar chart showing the distribution of Mahasiswa, Fakultas, and Prodi.
- WHEN the Dashboard screen loads, THE SYSTEM SHALL display the 5 most recently added Mahasiswa with their name, NIM, Prodi, and Fakultas.
- WHEN the user taps "View All" on the recent Mahasiswa section, THE SYSTEM SHALL navigate to the Mahasiswa list screen.

---

## 3. Mahasiswa Management

**User Stories:**
- As a user, I want to view all students so that I can browse the student registry.
- As a user, I want to search for a student by name or NIM so that I can find specific records quickly.
- As a user, I want to add a new student so that I can register new students into the system.
- As a user, I want to view a student's full detail so that I can see all information about them.
- As a user, I want to edit a student's data so that I can correct or update their information.
- As a user, I want to delete a student so that I can remove records that are no longer needed.

**Acceptance Criteria:**
- WHEN the Mahasiswa list loads, THE SYSTEM SHALL display all students with their name, NIM, and Prodi name.
- WHEN the user types in the search field, THE SYSTEM SHALL filter the list in real time by name or NIM.
- WHEN the user taps the Add button, THE SYSTEM SHALL show a form with fields: Nama, NIM, and Prodi (dropdown grouped by Fakultas).
- WHEN the user submits a valid form, THE SYSTEM SHALL create the record and return to the list with a success message.
- WHEN the user submits a form with a duplicate NIM, THE SYSTEM SHALL display a validation error on the NIM field.
- WHEN the user taps on a student, THE SYSTEM SHALL display a detail screen showing Nama, NIM, Prodi, and Fakultas.
- WHEN the user taps Edit on the detail screen, THE SYSTEM SHALL show a pre-filled edit form.
- WHEN the user taps Delete, THE SYSTEM SHALL show a confirmation dialog before deleting the record.
- WHEN a delete is confirmed, THE SYSTEM SHALL remove the record and navigate back to the list with a success message.

---

## 4. Fakultas Management

**User Stories:**
- As a user, I want to view all faculties so that I can see what departments are registered.
- As a user, I want to add a new faculty so that I can expand the department list.
- As a user, I want to view a faculty's detail so that I can see which study programs belong to it.
- As a user, I want to edit a faculty name so that I can correct or update it.
- As a user, I want to delete a faculty so that I can remove obsolete departments.

**Acceptance Criteria:**
- WHEN the Fakultas list loads, THE SYSTEM SHALL display all faculties with their name and the number of Prodi under each.
- WHEN the user taps Add, THE SYSTEM SHALL show a form with a single field: Nama.
- WHEN the user taps on a Fakultas, THE SYSTEM SHALL show a detail screen with the faculty name and its list of Prodi.
- WHEN the user taps Edit, THE SYSTEM SHALL show a pre-filled edit form.
- WHEN the user taps Delete, THE SYSTEM SHALL show a confirmation dialog before deleting.

---

## 5. Prodi Management

**User Stories:**
- As a user, I want to view all study programs so that I can see what programs are available.
- As a user, I want to add a new study program so that I can register new programs.
- As a user, I want to edit a study program so that I can update its name or faculty.
- As a user, I want to delete a study program so that I can remove programs that are no longer active.

**Acceptance Criteria:**
- WHEN the Prodi list loads, THE SYSTEM SHALL display all study programs with their name and associated Fakultas name.
- WHEN the user taps Add, THE SYSTEM SHALL show a form with fields: Nama and Fakultas (dropdown).
- WHEN the user taps Edit, THE SYSTEM SHALL show a pre-filled edit form.
- WHEN the user taps Delete, THE SYSTEM SHALL show a confirmation dialog before deleting.

---

## 6. Non-Functional Requirements

- THE SYSTEM SHALL support Android (API level 21+) and iOS (iOS 13+).
- THE SYSTEM SHALL use token-based authentication via Laravel Sanctum.
- THE SYSTEM SHALL handle network errors gracefully with user-friendly messages.
- THE SYSTEM SHALL persist the auth token securely using `flutter_secure_storage`.
- THE SYSTEM SHALL display a loading indicator while awaiting API responses.
- THE SYSTEM SHALL support pull-to-refresh on all list screens.
- THE UI SHALL maintain the retro/pixel aesthetic adapted for mobile (dark background, pixel fonts, bordered cards).
