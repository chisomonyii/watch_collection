<?php
// edit-profile.php

// IMPORTANT:
// sidebar.php should be included ONCE here, outside the main content.
\App\Helpers\View::displayComponent("Staff/sidebar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Profile | ZEITH</title>

    <style>
        /* =========================================================
           ZEITH STAFF - EDIT PROFILE
           ========================================================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --zeith-bg: #F4F6F9;
            --zeith-sidebar: #1E293B;
            --zeith-card: #FFFFFF;

            --zeith-text: #0F172A;
            --zeith-muted: #64748B;
            --zeith-light-muted: #94A3B8;

            --zeith-border: #E2E8F0;

            --zeith-primary: #2563EB;
            --zeith-primary-dark: #1D4ED8;
            --zeith-primary-soft: #EFF6FF;

            --zeith-success: #10B981;
            --zeith-danger: #EF4444;

            --sidebar-width: 250px;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            background: var(--zeith-bg);
            color: var(--zeith-text);
            font-family: Arial, Helvetica, sans-serif;
        }


        /* =========================================================
           MAIN PAGE AREA
           ========================================================= */

        .zeith-edit-profile-page {
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            padding: 32px;
        }


        /* =========================================================
           TOP BAR
           ========================================================= */

        .zeith-profile-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            margin-bottom: 28px;
        }

        .zeith-profile-heading {
            min-width: 0;
        }

        .zeith-profile-eyebrow {
            display: block;
            margin-bottom: 7px;

            color: var(--zeith-primary);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .zeith-profile-heading h1 {
            margin: 0 0 7px;

            color: var(--zeith-text);
            font-size: 28px;
            line-height: 1.2;
            font-weight: 700;
        }

        .zeith-profile-heading p {
            color: var(--zeith-muted);
            font-size: 14px;
            line-height: 1.6;
        }


        /* =========================================================
           MOBILE MENU BUTTON
           Works with the ZEITH sidebar
           ========================================================= */

        .zeith-mobile-menu {
            display: none;

            width: 42px;
            height: 42px;

            align-items: center;
            justify-content: center;

            border: 1px solid var(--zeith-border);
            border-radius: 10px;

            background: #FFFFFF;
            color: var(--zeith-text);

            cursor: pointer;
            flex-shrink: 0;
        }

        .zeith-mobile-menu svg {
            width: 21px;
            height: 21px;
        }

        .zeith-mobile-menu:hover {
            border-color: #CBD5E1;
            background: #F8FAFC;
        }


        /* =========================================================
           CONTENT LAYOUT
           ========================================================= */

        .zeith-profile-layout {
            display: grid;
            grid-template-columns: minmax(0, 760px) minmax(240px, 1fr);
            gap: 24px;
            align-items: start;
        }


        /* =========================================================
           PROFILE CARD
           ========================================================= */

        .zeith-profile-card {
            width: 100%;

            background: var(--zeith-card);
            border: 1px solid var(--zeith-border);
            border-radius: 14px;

            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);

            overflow: hidden;
        }


        /* =========================================================
           PROFILE HEADER
           ========================================================= */

        .zeith-profile-header {
            display: flex;
            align-items: center;
            gap: 20px;

            padding: 28px 30px;

            border-bottom: 1px solid var(--zeith-border);
        }

        .zeith-profile-avatar {
            position: relative;

            width: 82px;
            height: 82px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 16px;

            background: var(--zeith-primary-soft);
            color: var(--zeith-primary);

            font-size: 30px;
            font-weight: 700;

            border: 1px solid #DBEAFE;
        }

        .zeith-avatar-edit {
            position: absolute;

            right: -8px;
            bottom: -8px;

            width: 29px;
            height: 29px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 3px solid #FFFFFF;
            border-radius: 50%;

            background: var(--zeith-primary);
            color: #FFFFFF;

            font-size: 12px;
        }

        .zeith-profile-name {
            margin-bottom: 8px;

            color: var(--zeith-text);
            font-size: 22px;
            font-weight: 700;

            overflow-wrap: anywhere;
        }

        .zeith-role-badge {
            display: inline-flex;
            align-items: center;

            padding: 6px 11px;

            border-radius: 6px;

            background: #ECFDF5;
            color: #047857;

            font-size: 10px;
            font-weight: 700;

            letter-spacing: .7px;
            text-transform: uppercase;
        }


        /* =========================================================
           FORM
           ========================================================= */

        .zeith-profile-form {
            padding: 30px;
        }

        .zeith-form-section-title {
            margin-bottom: 20px;

            color: var(--zeith-text);
            font-size: 15px;
            font-weight: 700;
        }

        .zeith-form-section-title span {
            display: inline-block;

            width: 3px;
            height: 17px;

            margin-right: 9px;

            vertical-align: -3px;

            border-radius: 4px;
            background: var(--zeith-primary);
        }


        /* =========================================================
           FORM GRID
           ========================================================= */

        .zeith-name-fields {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;

            margin-bottom: 20px;
        }

        .zeith-form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;

            margin-bottom: 20px;

            min-width: 0;
        }

        .zeith-form-group:last-child {
            margin-bottom: 0;
        }

        .zeith-form-group label {
            color: var(--zeith-text);

            font-size: 12px;
            font-weight: 700;
        }

        .zeith-form-group label .required {
            color: var(--zeith-danger);
        }

        .zeith-form-group input {
            width: 100%;
            min-height: 47px;

            padding: 12px 14px;

            border: 1px solid var(--zeith-border);
            border-radius: 8px;

            outline: none;

            background: #FFFFFF;
            color: var(--zeith-text);

            font-size: 14px;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .zeith-form-group input::placeholder {
            color: #94A3B8;
        }

        .zeith-form-group input:hover {
            border-color: #CBD5E1;
        }

        .zeith-form-group input:focus {
            border-color: var(--zeith-primary);

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, .10);

            background: #FFFFFF;
        }


        /* =========================================================
           PASSWORD
           ========================================================= */

        .zeith-password-wrapper {
            position: relative;
        }

        .zeith-password-wrapper input {
            padding-right: 48px;
        }

        .zeith-toggle-password {
            position: absolute;

            top: 50%;
            right: 13px;

            width: 30px;
            height: 30px;

            transform: translateY(-50%);

            display: flex;
            align-items: center;
            justify-content: center;

            border: none;
            background: transparent;

            color: var(--zeith-muted);

            cursor: pointer;
        }

        .zeith-toggle-password:hover {
            color: var(--zeith-primary);
        }

        .zeith-toggle-password svg {
            width: 17px;
            height: 17px;
        }

        .zeith-password-note {
            margin-top: -9px;

            color: var(--zeith-muted);

            font-size: 12px;
            line-height: 1.5;
        }


        /* =========================================================
           FORM ACTIONS
           ========================================================= */

        .zeith-form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;

            gap: 12px;

            margin-top: 28px;
            padding-top: 24px;

            border-top: 1px solid var(--zeith-border);
        }

        .zeith-cancel-button,
        .zeith-save-button {
            min-height: 45px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            padding: 11px 20px;

            border-radius: 8px;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;
            text-decoration: none;

            transition:
                background .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }

        .zeith-cancel-button {
            border: 1px solid var(--zeith-border);

            background: #FFFFFF;
            color: var(--zeith-text);
        }

        .zeith-cancel-button:hover {
            background: #F8FAFC;
            border-color: #CBD5E1;
        }

        .zeith-save-button {
            border: 1px solid var(--zeith-primary);

            background: var(--zeith-primary);
            color: #FFFFFF;
        }

        .zeith-save-button:hover {
            background: var(--zeith-primary-dark);
            border-color: var(--zeith-primary-dark);

            transform: translateY(-1px);
        }

        .zeith-save-button svg,
        .zeith-cancel-button svg {
            width: 16px;
            height: 16px;
        }


        /* =========================================================
           SECURITY / ACCOUNT INFO CARD
           ========================================================= */

        .zeith-security-card {
            padding: 23px;

            background: #FFFFFF;

            border: 1px solid var(--zeith-border);
            border-radius: 14px;

            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
        }

        .zeith-security-title {
            display: flex;
            align-items: center;
            gap: 10px;

            margin-bottom: 15px;

            color: var(--zeith-text);
            font-size: 15px;
            font-weight: 700;
        }

        .zeith-security-icon {
            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: var(--zeith-primary-soft);
            color: var(--zeith-primary);
        }

        .zeith-security-icon svg {
            width: 17px;
            height: 17px;
        }

        .zeith-security-card p {
            color: var(--zeith-muted);

            font-size: 12px;
            line-height: 1.7;
        }

        .zeith-security-list {
            display: flex;
            flex-direction: column;

            gap: 12px;

            margin-top: 18px;
            padding-top: 17px;

            border-top: 1px solid var(--zeith-border);
        }

        .zeith-security-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;

            color: var(--zeith-muted);

            font-size: 12px;
            line-height: 1.5;
        }

        .zeith-security-item svg {
            width: 15px;
            height: 15px;

            margin-top: 1px;

            flex-shrink: 0;

            color: var(--zeith-success);
        }


        /* =========================================================
           TABLET / IPAD
           ========================================================= */

        @media (max-width: 1100px) {

            .zeith-profile-layout {
                grid-template-columns: 1fr;
            }

            .zeith-profile-card {
                max-width: 760px;
            }

            .zeith-security-card {
                max-width: 760px;
            }
        }


        /* =========================================================
           SIDEBAR OFF-CANVAS
           ========================================================= */

        @media (max-width: 1024px) {

            .zeith-edit-profile-page {
                width: 100%;
                margin-left: 0;

                padding: 26px 24px 40px;
            }

            .zeith-mobile-menu {
                display: flex;
            }

            .zeith-profile-topbar {
                align-items: flex-start;
            }
        }


        /* =========================================================
           MOBILE
           ========================================================= */

        @media (max-width: 600px) {

            .zeith-edit-profile-page {
                padding: 20px 15px 35px;
            }

            .zeith-profile-topbar {
                gap: 12px;
                margin-bottom: 20px;
            }

            .zeith-profile-eyebrow {
                font-size: 10px;
            }

            .zeith-profile-heading h1 {
                font-size: 23px;
            }

            .zeith-profile-heading p {
                font-size: 12px;
            }

            .zeith-mobile-menu {
                width: 40px;
                height: 40px;
            }

            .zeith-profile-header {
                padding: 22px 18px;
            }

            .zeith-profile-avatar {
                width: 70px;
                height: 70px;

                border-radius: 14px;

                font-size: 25px;
            }

            .zeith-profile-name {
                font-size: 19px;
            }

            .zeith-profile-form {
                padding: 22px 18px;
            }

            .zeith-name-fields {
                grid-template-columns: 1fr;
                gap: 20px;

                margin-bottom: 20px;
            }

            .zeith-form-actions {
                flex-direction: column-reverse;
            }

            .zeith-save-button,
            .zeith-cancel-button {
                width: 100%;
            }

            .zeith-security-card {
                padding: 20px 18px;
            }
        }


        /* =========================================================
           SMALL MOBILE
           ========================================================= */

        @media (max-width: 380px) {

            .zeith-edit-profile-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .zeith-profile-heading h1 {
                font-size: 21px;
            }

            .zeith-profile-header {
                gap: 14px;
            }

            .zeith-profile-avatar {
                width: 62px;
                height: 62px;
            }

            .zeith-profile-name {
                font-size: 17px;
            }
        }
    </style>
</head>

<body>

    <!-- =========================================================
         EDIT PROFILE PAGE
         ========================================================= -->

    <main class="zeith-edit-profile-page">

        <!-- PAGE HEADER -->
        <div class="zeith-profile-topbar">

            <div class="zeith-profile-heading">

                <span class="zeith-profile-eyebrow">
                    Account Settings
                </span>

                <h1>Edit Profile</h1>

                <p>
                    Update your personal information and account security.
                </p>

            </div>

            <!-- MOBILE / IPAD SIDEBAR BUTTON -->
            <button
                type="button"
                class="zeith-mobile-menu"
                aria-label="Open navigation"
                aria-expanded="false">

                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round">

                    <line x1="4" y1="6" x2="20" y2="6"></line>
                    <line x1="4" y1="12" x2="20" y2="12"></line>
                    <line x1="4" y1="18" x2="20" y2="18"></line>

                </svg>

            </button>

        </div>


        <!-- PAGE CONTENT -->
        <div class="zeith-profile-layout">


            <!-- =================================================
                 MAIN PROFILE CARD
                 ================================================= -->

            <section class="zeith-profile-card">

                <!-- PROFILE HEADER -->
                <div class="zeith-profile-header">

                    <div class="zeith-profile-avatar">

                        H

                        <span class="zeith-avatar-edit">

                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">

                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"></path>

                            </svg>

                        </span>

                    </div>

                    <div>

                        <h2 class="zeith-profile-name">
                            Hexagon
                        </h2>

                        <span class="zeith-role-badge">
                            Staff
                        </span>

                    </div>

                </div>


                <!-- =================================================
                     FORM
                     ================================================= -->

                <form
                    class="zeith-profile-form"
                    id="editProfileForm">


                    <!-- SECTION TITLE -->
                    <h3 class="zeith-form-section-title">

                        <span></span>

                        Personal Information

                    </h3>


                    <!-- FIRST + LAST NAME -->
                    <div class="zeith-name-fields">

                        <div class="zeith-form-group">

                            <label for="firstName">
                                First Name
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="firstName"
                                name="firstName"
                                value="John"
                                placeholder="Enter your first name"
                                autocomplete="given-name"
                                required>

                        </div>


                        <div class="zeith-form-group">

                            <label for="lastName">
                                Last Name
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="lastName"
                                name="lastName"
                                value="Doe"
                                placeholder="Enter your last name"
                                autocomplete="family-name"
                                required>

                        </div>

                    </div>


                    <!-- EMAIL -->
                    <div class="zeith-form-group">

                        <label for="email">
                            Email Address
                            <span class="required">*</span>
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="johndoe@example.com"
                            placeholder="Enter your email address"
                            autocomplete="email"
                            required>

                    </div>


                    <!-- =================================================
                         SECURITY SECTION
                         ================================================= -->

                    <h3
                        class="zeith-form-section-title"
                        style="margin-top: 8px;">

                        <span></span>

                        Change Password

                    </h3>


                    <!-- PASSWORD -->
                    <div class="zeith-form-group">

                        <label for="password">
                            New Password
                        </label>

                        <div class="zeith-password-wrapper">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter a new password"
                                autocomplete="new-password">

                            <button
                                type="button"
                                class="zeith-toggle-password"
                                data-target="password"
                                aria-label="Show password">

                                <svg
                                    class="zeith-eye-icon"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>

                                </svg>

                            </button>

                        </div>

                    </div>


                    <!-- CONFIRM PASSWORD -->
                    <div class="zeith-form-group">

                        <label for="confirmPassword">
                            Confirm Password
                        </label>

                        <div class="zeith-password-wrapper">

                            <input
                                type="password"
                                id="confirmPassword"
                                name="confirmPassword"
                                placeholder="Confirm your new password"
                                autocomplete="new-password">

                            <button
                                type="button"
                                class="zeith-toggle-password"
                                data-target="confirmPassword"
                                aria-label="Show password">

                                <svg
                                    class="zeith-eye-icon"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>

                                </svg>

                            </button>

                        </div>

                    </div>


                    <p class="zeith-password-note">
                        Leave both password fields blank if you do not
                        want to change your current password.
                    </p>


                    <!-- =================================================
                         ACTION BUTTONS
                         ================================================= -->

                    <div class="zeith-form-actions">

                        <a
                            href="profile.php"
                            class="zeith-cancel-button">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round">

                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>

                            </svg>

                            Cancel

                        </a>


                        <button
                            type="submit"
                            class="zeith-save-button">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">

                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>

                            </svg>

                            Save Changes

                        </button>

                    </div>

                </form>

            </section>


            <!-- =================================================
                 SECURITY INFORMATION
                 ================================================= -->

            <aside class="zeith-security-card">

                <div class="zeith-security-title">

                    <span class="zeith-security-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">

                            <rect
                                x="3"
                                y="11"
                                width="18"
                                height="10"
                                rx="2">
                            </rect>

                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>

                        </svg>

                    </span>

                    Account Security

                </div>


                <p>
                    Keep your ZEITH staff account secure by using
                    a strong and unique password.
                </p>


                <div class="zeith-security-list">

                    <div class="zeith-security-item">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            stroke-linecap="round"
                            stroke-linejoin="round">

                            <polyline points="20 6 9 17 4 12"></polyline>

                        </svg>

                        Use at least 8 characters.

                    </div>


                    <div class="zeith-security-item">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            stroke-linecap="round"
                            stroke-linejoin="round">

                            <polyline points="20 6 9 17 4 12"></polyline>

                        </svg>

                        Combine letters and numbers.

                    </div>


                    <div class="zeith-security-item">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            stroke-linecap="round"
                            stroke-linejoin="round">

                            <polyline points="20 6 9 17 4 12"></polyline>

                        </svg>

                        Avoid using easily guessed passwords.

                    </div>

                </div>

            </aside>

        </div>

    </main>


    <!-- =========================================================
         JAVASCRIPT
         ========================================================= -->

    <script>

        /* =========================================================
           PASSWORD SHOW / HIDE
           ========================================================= */

        document
            .querySelectorAll(".zeith-toggle-password")
            .forEach(button => {

                button.addEventListener("click", function () {

                    const targetId = this.dataset.target;
                    const input = document.getElementById(targetId);

                    if (!input) {
                        return;
                    }

                    const showing = input.type === "password";

                    input.type = showing ? "text" : "password";

                    this.setAttribute(
                        "aria-label",
                        showing ? "Hide password" : "Show password"
                    );

                    /*
                     * Replace eye with eye-slash style.
                     */
                    const icon = this.querySelector("svg");

                    if (showing) {

                        icon.innerHTML = `
                            <path d="M3 3l18 18"></path>
                            <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"></path>
                            <path d="M9.9 5.1A10.6 10.6 0 0 1 12 5c6.5 0 10 7 10 7a17.2 17.2 0 0 1-3.2 4.1"></path>
                            <path d="M6.6 6.6C3.7 8.6 2 12 2 12s3.5 7 10 7c1.6 0 3-.4 4.2-1"></path>
                        `;

                    } else {

                        icon.innerHTML = `
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        `;
                    }

                });

            });


        /* =========================================================
           FORM VALIDATION
           ========================================================= */

        const editProfileForm =
            document.getElementById("editProfileForm");

        if (editProfileForm) {

            editProfileForm.addEventListener(
                "submit",
                function (event) {

                    event.preventDefault();

                    const password =
                        document.getElementById("password").value;

                    const confirmPassword =
                        document.getElementById("confirmPassword").value;


                    /*
                     * Only validate if a new password
                     * was entered.
                     */
                    if (password !== "" || confirmPassword !== "") {

                        if (password !== confirmPassword) {

                            alert(
                                "Your passwords do not match."
                            );

                            return;
                        }

                        if (password.length < 8) {

                            alert(
                                "Your new password must contain at least 8 characters."
                            );

                            return;
                        }
                    }


                    /*
                     * Demo only.
                     * Replace this with your PHP form action later.
                     */
                    alert(
                        "Profile changes are ready to be saved."
                    );

                }
            );

        }


        /* =========================================================
           MOBILE / IPAD SIDEBAR TOGGLE
           ========================================================= */

        const mobileMenu =
            document.querySelector(".zeith-mobile-menu");

        if (mobileMenu) {

            mobileMenu.addEventListener("click", function () {

                /*
                 * This matches the sidebar system we created:
                 * body.zeith-menu-open
                 */

                const isOpen =
                    document.body.classList.toggle(
                        "zeith-menu-open"
                    );

                this.setAttribute(
                    "aria-expanded",
                    isOpen ? "true" : "false"
                );

            });

        }


        /* =========================================================
           CLOSE SIDEBAR WITH ESCAPE
           ========================================================= */

        document.addEventListener(
            "keydown",
            function (event) {

                if (event.key === "Escape") {

                    document.body.classList.remove(
                        "zeith-menu-open"
                    );

                    if (mobileMenu) {

                        mobileMenu.setAttribute(
                            "aria-expanded",
                            "false"
                        );

                    }

                }

            }
        );

    </script>

</body>
</html>