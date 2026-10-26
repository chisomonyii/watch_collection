<?php
// Fallback data loading if not passed directly from controller
$user = $staffUser ?? $_SESSION['user'] ?? [];
$firstName = $user['firstname'] ?? 'John';
$lastName = $user['lastname'] ?? 'Doe';
$fullName = trim($firstName . ' ' . $lastName);
$email = $user['email'] ?? 'johndoe@gmail.com';
$role = ucfirst($user['role'] ?? 'Staff Administrator');
$initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
?>



<div class="contact-page">
    <?php \App\Helpers\View::displayComponent("Staff/sidebar.php"); ?>

    <main class="zeith-profile-page">
        <header class="zeith-profile-heading">
            <div>
                <span class="zeith-profile-eyebrow">STAFF ACCOUNT</span>
                <h1>Personal Profile</h1>
                <p>Manage your personal information and account settings.</p>
            </div>
        </header>

        <!-- Profile Form Wrapper for Editing -->
        <form action="/Watch_Collection/staff/profile/update" method="POST" class="zeith-profile-layout" id="profileForm">

            <section class="zeith-profile-card">
                <div class="zeith-profile-header">
                    <div class="zeith-profile-avatar"><?= htmlspecialchars($initials ?: 'Z') ?></div>
                    <div class="zeith-profile-identity">
                        <h2><?= htmlspecialchars($fullName) ?></h2>
                        <span class="zeith-role-badge"><?= htmlspecialchars($role) ?></span>
                    </div>
                </div>

                <div class="zeith-profile-details">

                    <!-- Full Name Row (Split into First & Last for DB sync) -->
                    <div class="zeith-detail-row">
                        <div class="zeith-detail-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"></path>
                            </svg>
                        </div>
                        <div class="zeith-detail-content">
                            <span class="zeith-detail-label">Full Name</span>
                            <span class="zeith-detail-value" id="fullNameValue"><?= htmlspecialchars($fullName) ?></span>
                            
                            <div class="name-inputs-group" id="nameInputsGroup" style="display: none; gap: 10px; margin-top: 5px;">
                                <input type="text" name="firstname" class="zeith-profile-input" value="<?= htmlspecialchars($firstName) ?>" placeholder="First Name" required style="width: 48%; padding: 8px; border: 1px solid #CBD5E1; border-radius: 6px;">
                                <input type="text" name="lastname" class="zeith-profile-input" value="<?= htmlspecialchars($lastName) ?>" placeholder="Last Name" required style="width: 48%; padding: 8px; border: 1px solid #CBD5E1; border-radius: 6px;">
                            </div>
                        </div>
                    </div>

                    <!-- Email Address Row -->
                    <div class="zeith-detail-row">
                        <div class="zeith-detail-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                <path d="M3 7l9 6 9-6"></path>
                            </svg>
                        </div>
                        <div class="zeith-detail-content">
                            <span class="zeith-detail-label">Email Address</span>
                            <span class="zeith-detail-value" id="emailValue"><?= htmlspecialchars($email) ?></span>
                            <input type="email" name="email" class="zeith-profile-input" id="emailInput" value="<?= htmlspecialchars($email) ?>" style="display: none; width: 100%; padding: 8px; border: 1px solid #CBD5E1; border-radius: 6px; margin-top: 5px;" required>
                        </div>
                    </div>

                    <!-- Password Row (Optional update) -->
                    <div class="zeith-detail-row">
                        <div class="zeith-detail-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <rect x="5" y="10" width="14" height="10" rx="2"></rect>
                                <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                            </svg>
                        </div>
                        <div class="zeith-detail-content">
                            <span class="zeith-detail-label">Password</span>
                            <div class="zeith-password-wrapper">
                                <span class="zeith-detail-value" id="passwordText">••••••••••</span>
                                <input type="password" name="password" class="zeith-profile-input" id="passwordInput" placeholder="Leave blank to keep current password" style="display: none; width: 100%; padding: 8px; border: 1px solid #CBD5E1; border-radius: 6px; margin-top: 5px;">
                            </div>
                        </div>
                    </div>

                    <!-- Account Role Row -->
                    <div class="zeith-detail-row">
                        <div class="zeith-detail-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"></path>
                                <path d="M9 12l2 2 4-4"></path>
                            </svg>
                        </div>
                        <div class="zeith-detail-content">
                            <span class="zeith-detail-label">Account Role</span>
                            <span class="zeith-detail-value"><?= htmlspecialchars($role) ?></span>
                        </div>
                    </div>

                </div>

                <div class="zeith-profile-footer">
                    <!-- Edit Button -->
                    <button type="button" class="zeith-edit-profile-btn" id="editProfileBtn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="width:18px;height:18px;margin-right:6px;">
                            <path d="M12 20h9"></path>
                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4L16.5 3.5z"></path>
                        </svg>
                        <span>Edit Profile Details</span>
                    </button>

                    <!-- Save / Cancel Actions (Hidden by default, shown in Frame 3) -->
                    <div class="zeith-edit-actions" id="editActions" style="display: none; gap: 10px;">
                        <button type="button" class="zeith-cancel-btn" id="cancelEditBtn" style="padding: 10px 20px; background: #E2E8F0; border: none; border-radius: 6px; cursor: pointer;">
                            Cancel
                        </button>
                        <button type="submit" class="zeith-save-btn" id="saveProfileBtn" style="padding: 10px 20px; background: #2563EB; color: white; border: none; border-radius: 6px; cursor: pointer;">
                            Save Changes
                        </button>
                    </div>
                </div>

            </section>

            <aside class="zeith-account-card">
                <div class="zeith-account-card-header">
                    <div class="zeith-account-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="width:20px;height:20px;">
                            <path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"></path>
                            <path d="M9 12l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3>Account Security</h3>
                        <p>Keep your staff account secure.</p>
                    </div>
                </div>

                <div class="zeith-security-item">
                    <div>
                        <strong>Password</strong>
                        <span>Your password is protected.</span>
                    </div>
                    <span class="zeith-security-status">Protected</span>
                </div>

                <div class="zeith-security-item">
                    <div>
                        <strong>Account Status</strong>
                        <span>Your staff account is active.</span>
                    </div>
                    <span class="zeith-active-status" style="color: #10B981; font-weight: 600;">Active</span>
                </div>

                <div class="zeith-security-note" style="margin-top: 20px; font-size: 13px; color: #64748B; display: flex; gap: 8px;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="width:18px;height:18px;flex-shrink:0;">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M12 10v6"></path>
                        <circle cx="12" cy="7" r=".6" fill="currentColor" stroke="none"></circle>
                    </svg>
                    <p>Never share your staff login credentials with anyone.</p>
                </div>
            </aside>

        </form>
    </main>
</div>


<style>

/* =========================================================
   ZEITH STAFF PROFILE
========================================================= */

* {
    box-sizing: border-box;
}

.zeith-profile-page {

    width: calc(100% - 250px);

    min-height: 100vh;

    margin-left: 250px;

    padding: 34px 34px 50px;

    background: #F4F6F9;

    color: #0F172A;

    font-family:
        Arial,
        Helvetica,
        sans-serif;
}


/* =========================================================
   PAGE HEADING
========================================================= */

.zeith-profile-heading {

    margin-bottom: 28px;

    display: flex;

    align-items: flex-start;

    justify-content: space-between;
}


.zeith-profile-eyebrow {

    display: block;

    margin-bottom: 7px;

    color: #2563EB;

    font-size: 11px;

    font-weight: 700;

    letter-spacing: 1.4px;

    text-transform: uppercase;
}


.zeith-profile-heading h1 {

    margin: 0 0 7px;

    color: #0F172A;

    font-size: 27px;

    line-height: 1.2;

    font-weight: 700;
}


.zeith-profile-heading p {

    margin: 0;

    color: #64748B;

    font-size: 14px;

    line-height: 1.6;
}


/* =========================================================
   PROFILE LAYOUT
========================================================= */

.zeith-profile-layout {

    width: 100%;

    display: grid;

    grid-template-columns:
        minmax(0, 690px)
        minmax(260px, 350px);

    gap: 24px;

    align-items: start;
}


/* =========================================================
   PROFILE CARD
========================================================= */

.zeith-profile-card {

    width: 100%;

    background: #FFFFFF;

    border: 1px solid #E2E8F0;

    border-radius: 14px;

    padding: 30px;

    box-shadow:
        0 4px 15px rgba(15, 23, 42, .04);
}


/* =========================================================
   PROFILE HEADER
========================================================= */

.zeith-profile-header {

    display: flex;

    align-items: center;

    gap: 18px;

    padding-bottom: 27px;

    border-bottom: 1px solid #E2E8F0;
}


.zeith-profile-avatar {

    width: 86px;

    height: 86px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #DBEAFE;

    color: #2563EB;

    border: 1px solid #BFDBFE;

    border-radius: 14px;

    font-size: 30px;

    font-weight: 800;

    box-shadow:
        0 4px 12px rgba(37, 99, 235, .08);
}


.zeith-profile-identity h2 {

    margin: 0 0 9px;

    color: #0F172A;

    font-size: 22px;

    font-weight: 700;
}


.zeith-role-badge {

    display: inline-flex;

    align-items: center;

    padding: 6px 11px;

    border-radius: 6px;

    background: #EFF6FF;

    color: #2563EB;

    border: 1px solid #DBEAFE;

    font-size: 10px;

    font-weight: 700;

    letter-spacing: .6px;

    text-transform: uppercase;
}


/* =========================================================
   PROFILE DETAILS
========================================================= */

.zeith-profile-details {

    display: flex;

    flex-direction: column;

    gap: 0;

    padding: 5px 0 8px;
}


.zeith-detail-row {

    display: flex;

    align-items: center;

    gap: 18px;

    min-width: 0;

    padding: 21px 3px;

    border-bottom: 1px solid #F1F5F9;
}


.zeith-detail-row:last-child {

    border-bottom: none;
}


.zeith-detail-icon {

    width: 40px;

    height: 40px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #F8FAFC;

    border: 1px solid #E2E8F0;

    border-radius: 9px;

    color: #2563EB;
}


.zeith-detail-icon svg {

    width: 18px;

    height: 18px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.7;

    stroke-linecap: round;

    stroke-linejoin: round;
}


.zeith-detail-content {

    min-width: 0;

    flex: 1;
}


.zeith-detail-label {

    display: block;

    margin-bottom: 6px;

    color: #64748B;

    font-size: 12px;

    font-weight: 500;
}


.zeith-detail-value {

    display: block;

    color: #0F172A;

    font-size: 14px;

    font-weight: 600;

    overflow-wrap: anywhere;
}


/* =========================================================
   EDIT INPUTS
========================================================= */

.zeith-profile-input {

    display: none;

    width: 100%;

    height: 42px;

    padding: 0 12px;

    background: #FFFFFF;

    border: 1px solid #CBD5E1;

    border-radius: 8px;

    color: #0F172A;

    font-size: 14px;

    outline: none;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}


.zeith-profile-input:focus {

    border-color: #2563EB;

    box-shadow:
        0 0 0 3px rgba(37, 99, 235, .10);
}


/* =========================================================
   PASSWORD
========================================================= */

.zeith-password-wrapper {

    display: flex;

    align-items: center;

    gap: 10px;
}


.zeith-password-toggle {

    width: 30px;

    height: 30px;

    display: flex;

    align-items: center;

    justify-content: center;

    border: none;

    background: transparent;

    color: #64748B;

    cursor: pointer;

    border-radius: 6px;

    transition:
        color .2s ease,
        background .2s ease;
}


.zeith-password-toggle:hover {

    color: #2563EB;

    background: #EFF6FF;
}


.zeith-password-toggle svg {

    width: 17px;

    height: 17px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.7;

    stroke-linecap: round;

    stroke-linejoin: round;
}


/* =========================================================
   PROFILE FOOTER
========================================================= */

.zeith-profile-footer {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding-top: 23px;

    border-top: 1px solid #E2E8F0;
}


.zeith-edit-profile-btn {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 9px;

    min-height: 43px;

    padding: 0 18px;

    background: #2563EB;

    color: #FFFFFF;

    border: none;

    border-radius: 8px;

    font-size: 13px;

    font-weight: 600;

    cursor: pointer;

    transition:
        background .2s ease,
        transform .2s ease,
        box-shadow .2s ease;
}


.zeith-edit-profile-btn:hover {

    background: #1D4ED8;

    transform: translateY(-1px);

    box-shadow:
        0 5px 14px rgba(37, 99, 235, .18);
}


.zeith-edit-profile-btn svg {

    width: 16px;

    height: 16px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;

    stroke-linejoin: round;
}


/* =========================================================
   EDIT ACTIONS
========================================================= */

.zeith-edit-actions {

    display: none;

    align-items: center;

    gap: 9px;
}


.zeith-cancel-btn,
.zeith-save-btn {

    min-height: 40px;

    padding: 0 15px;

    border-radius: 8px;

    font-size: 12px;

    font-weight: 600;

    cursor: pointer;
}


.zeith-cancel-btn {

    background: #FFFFFF;

    color: #475569;

    border: 1px solid #CBD5E1;
}


.zeith-cancel-btn:hover {

    background: #F8FAFC;
}


.zeith-save-btn {

    background: #2563EB;

    color: #FFFFFF;

    border: 1px solid #2563EB;
}


.zeith-save-btn:hover {

    background: #1D4ED8;
}


/* =========================================================
   SECURITY CARD
========================================================= */

.zeith-account-card {

    width: 100%;

    padding: 24px;

    background: #FFFFFF;

    border: 1px solid #E2E8F0;

    border-radius: 14px;

    box-shadow:
        0 4px 15px rgba(15, 23, 42, .04);
}


.zeith-account-card-header {

    display: flex;

    align-items: flex-start;

    gap: 13px;

    padding-bottom: 20px;

    border-bottom: 1px solid #E2E8F0;
}


.zeith-account-icon {

    width: 40px;

    height: 40px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #EFF6FF;

    color: #2563EB;

    border-radius: 9px;
}


.zeith-account-icon svg {

    width: 19px;

    height: 19px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.7;

    stroke-linecap: round;

    stroke-linejoin: round;
}


.zeith-account-card-header h3 {

    margin: 2px 0 5px;

    color: #0F172A;

    font-size: 15px;

    font-weight: 700;
}


.zeith-account-card-header p {

    margin: 0;

    color: #64748B;

    font-size: 11px;

    line-height: 1.5;
}


/* =========================================================
   SECURITY ITEMS
========================================================= */

.zeith-security-item {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 18px 0;

    border-bottom: 1px solid #F1F5F9;
}


.zeith-security-item strong {

    display: block;

    margin-bottom: 5px;

    color: #0F172A;

    font-size: 12px;
}


.zeith-security-item span:not(
    .zeith-security-status,
    .zeith-active-status
) {

    display: block;

    color: #64748B;

    font-size: 10px;
}


.zeith-security-status,
.zeith-active-status {

    flex-shrink: 0;

    padding: 5px 8px;

    border-radius: 5px;

    background: #ECFDF5;

    color: #059669;

    font-size: 9px;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: .4px;
}


/* =========================================================
   SECURITY NOTE
========================================================= */

.zeith-security-note {

    display: flex;

    align-items: flex-start;

    gap: 9px;

    margin-top: 18px;

    padding: 12px;

    background: #F8FAFC;

    border: 1px solid #E2E8F0;

    border-radius: 8px;
}


.zeith-security-note svg {

    width: 15px;

    height: 15px;

    flex-shrink: 0;

    margin-top: 1px;

    fill: none;

    stroke: #64748B;

    stroke-width: 1.7;
}


.zeith-security-note p {

    margin: 0;

    color: #64748B;

    font-size: 10px;

    line-height: 1.5;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 1100px) {

    .zeith-profile-layout {

        grid-template-columns: 1fr;

        max-width: 760px;
    }

}


/* =========================================================
   IPAD / TABLET
========================================================= */

@media (max-width: 1024px) {

    .zeith-profile-page {

        width: 100%;

        margin-left: 0;

        padding: 30px 28px 45px;
    }

}


/* =========================================================
   SMALL TABLET
========================================================= */

@media (max-width: 767px) {

    .zeith-profile-page {

        padding: 75px 20px 35px;
    }


    .zeith-profile-heading h1 {

        font-size: 24px;
    }


    .zeith-profile-heading p {

        font-size: 13px;
    }


    .zeith-profile-card {

        padding: 23px 20px;
    }


    .zeith-account-card {

        padding: 20px;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 480px) {

    .zeith-profile-page {

        padding:
            70px
            14px
            30px;
    }


    .zeith-profile-heading {

        margin-bottom: 20px;
    }


    .zeith-profile-eyebrow {

        font-size: 9px;
    }


    .zeith-profile-heading h1 {

        font-size: 22px;

        margin-bottom: 6px;
    }


    .zeith-profile-heading p {

        font-size: 12px;
    }


    .zeith-profile-card {

        padding: 20px 16px;

        border-radius: 12px;
    }


    .zeith-profile-header {

        gap: 13px;

        padding-bottom: 22px;
    }


    .zeith-profile-avatar {

        width: 68px;

        height: 68px;

        border-radius: 11px;

        font-size: 25px;
    }


    .zeith-profile-identity h2 {

        font-size: 18px;
    }


    .zeith-role-badge {

        font-size: 8px;

        padding: 5px 8px;
    }


    .zeith-detail-row {

        gap: 12px;

        padding: 17px 0;
    }


    .zeith-detail-icon {

        width: 36px;

        height: 36px;

        border-radius: 8px;
    }


    .zeith-detail-icon svg {

        width: 16px;

        height: 16px;
    }


    .zeith-detail-label {

        font-size: 10px;

        margin-bottom: 5px;
    }


    .zeith-detail-value {

        font-size: 12px;
    }


    .zeith-profile-footer {

        flex-direction: column;

        align-items: stretch;
    }


    .zeith-edit-profile-btn {

        width: 100%;
    }


    .zeith-edit-actions {

        width: 100%;
    }


    .zeith-cancel-btn,
    .zeith-save-btn {

        flex: 1;
    }


    .zeith-account-card {

        border-radius: 12px;
    }

}


/* =========================================================
   ACCESSIBILITY
========================================================= */

.zeith-edit-profile-btn:focus-visible,
.zeith-cancel-btn:focus-visible,
.zeith-save-btn:focus-visible,
.zeith-password-toggle:focus-visible,
.zeith-profile-input:focus-visible {

    outline: 3px solid rgba(37, 99, 235, .20);

    outline-offset: 2px;
}

</style>


<script>
    const editBtn = document.getElementById('editProfileBtn');
    const cancelBtn = document.getElementById('cancelEditBtn');
    const editActions = document.getElementById('editActions');
    
    const fullNameValue = document.getElementById('fullNameValue');
    const nameInputsGroup = document.getElementById('nameInputsGroup');

    const emailValue = document.getElementById('emailValue');
    const emailInput = document.getElementById('emailInput');

    const passwordText = document.getElementById('passwordText');
    const passwordInput = document.getElementById('passwordInput');

    editBtn.addEventListener('click', () => {
        // Hide read-only spans, show input fields
        fullNameValue.style.display = 'none';
        nameInputsGroup.style.display = 'flex';

        emailValue.style.display = 'none';
        emailInput.style.display = 'block';

        passwordText.style.display = 'none';
        passwordInput.style.display = 'block';

        // Toggle buttons
        editBtn.style.display = 'none';
        editActions.style.display = 'flex';
    });

    cancelBtn.addEventListener('click', () => {
        // Revert inputs, show read-only spans
        fullNameValue.style.display = 'inline';
        nameInputsGroup.style.display = 'none';

        emailValue.style.display = 'inline';
        emailInput.style.display = 'none';

        passwordText.style.display = 'inline';
        passwordInput.style.display = 'none';

        // Toggle buttons back
        editBtn.style.display = 'inline-flex';
        editActions.style.display = 'none';
    });
</script>