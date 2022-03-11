import React from 'react'
import { useRouter } from 'next/router';
import Link from 'next/link'

const Navbar = () => {
  const router = useRouter();

  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-light px-4">
      <a className="navbar-brand" href="#">Navbar</a>
      <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span className="navbar-toggler-icon" />
      </button>
      <div className="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div className="navbar-nav">
          <Link href="/">
            <a className={"nav-item nav-link" + (router.pathname === '/' ? ' active' : '')}>Home</a>
          </Link>
          <Link href="/repository">
            <a className={"nav-item nav-link" + (router.pathname === '/repository' ? ' active' : '')}>Repository</a>
          </Link>
        </div>
      </div>
    </nav>
  )
}

export default Navbar