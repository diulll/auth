import { useState } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Login({ status, canResetPassword }) {
    const [isSignUp, setIsSignUp] = useState(false);
    
    return (
        <>
            <Head title="Login / Register" />
            <div className="section full-height">
                <div style={{ width: '100%', textAlign: 'center' }}>
                    <div className="section pb-5 pt-5 pt-sm-2 text-center">
                        <h6 className="mb-0 pb-3">
                            <span>Log In </span>
                            <span>Sign Up</span>
                        </h6>
                        <input
                            className="checkbox"
                            type="checkbox"
                            id="reg-log"
                            checked={isSignUp}
                            onChange={(e) => setIsSignUp(e.target.checked)}
                        />
                        <label htmlFor="reg-log"></label>
                        <div className="card-3d-wrap mx-auto">
                            <div className="card-3d-wrapper">
                                {!isSignUp ? <LogInForm status={status} canResetPassword={canResetPassword} /> : <SignUpForm />}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

function LogInForm({ status, canResetPassword }) {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('login'));
    };

    return (
        <div className="card-front">
            <div className="center-wrap">
                <div className="section text-center">
                    <h4 className="mb-4 pb-3">Log In</h4>
                    {status && <div className="alert alert-success">{status}</div>}
                    <form onSubmit={submit}>
                        <div className="form-group">
                            <input
                                type="email"
                                className="form-style"
                                placeholder="Your Email"
                                value={data.email}
                                onChange={(e) => setData('email', e.target.value)}
                            />
                            <i className="input-icon uil uil-at"></i>
                            {errors.email && <p className="text-danger">{errors.email}</p>}
                        </div>
                        <div className="form-group mt-2">
                            <input
                                type="password"
                                className="form-style"
                                placeholder="Your Password"
                                value={data.password}
                                onChange={(e) => setData('password', e.target.value)}
                            />
                            <i className="input-icon uil uil-lock-alt"></i>
                            {errors.password && <p className="text-danger">{errors.password}</p>}
                        </div>
                        <button type="submit" className="btn mt-4" disabled={processing}>
                            {processing ? 'Loading...' : 'Submit'}
                        </button>
                    </form>
                    <p className="mb-0 mt-4 text-center">
                        {canResetPassword && (
                            <Link href={route('password.request')} className="link">
                                Forgot your password?
                            </Link>
                        )}
                    </p>
                </div>
            </div>
        </div>
    );
}

function SignUpForm() {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('register'));
    };

    return (
        <div className="card-back">
            <div className="center-wrap">
                <div className="section text-center">
                    <h4 className="mb-4 pb-3">Sign Up</h4>
                    <form onSubmit={submit}>
                        <div className="form-group">
                            <input
                                type="text"
                                className="form-style"
                                placeholder="Your Full Name"
                                value={data.name}
                                onChange={(e) => setData('name', e.target.value)}
                            />
                            <i className="input-icon uil uil-user"></i>
                            {errors.name && <p className="text-danger">{errors.name}</p>}
                        </div>
                        <div className="form-group mt-2">
                            <input
                                type="email"
                                className="form-style"
                                placeholder="Your Email"
                                value={data.email}
                                onChange={(e) => setData('email', e.target.value)}
                            />
                            <i className="input-icon uil uil-at"></i>
                            {errors.email && <p className="text-danger">{errors.email}</p>}
                        </div>
                        <div className="form-group mt-2">
                            <input
                                type="password"
                                className="form-style"
                                placeholder="Your Password"
                                value={data.password}
                                onChange={(e) => setData('password', e.target.value)}
                            />
                            <i className="input-icon uil uil-lock-alt"></i>
                            {errors.password && <p className="text-danger">{errors.password}</p>}
                        </div>
                        <div className="form-group mt-2">
                            <input
                                type="password"
                                className="form-style"
                                placeholder="Confirm Password"
                                value={data.password_confirmation}
                                onChange={(e) => setData('password_confirmation', e.target.value)}
                            />
                            <i className="input-icon uil uil-lock-alt"></i>
                            {errors.password_confirmation && <p className="text-danger">{errors.password_confirmation}</p>}
                        </div>
                        <button type="submit" className="btn mt-4" disabled={processing}>
                            {processing ? 'Loading...' : 'Submit'}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    );
}
