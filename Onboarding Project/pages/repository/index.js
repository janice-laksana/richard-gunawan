import React, { useRef, useState } from "react";
import styles from "../../styles/Home.module.css";
import { useLazyQuery } from "@apollo/client";
import { SEARCH_REPOSITORIES } from "../../GraphQL/Queries";
import Link from 'next/link'


export default function Repository() {
  const [getRepositories, { loading, data, fetchMore }] = useLazyQuery(SEARCH_REPOSITORIES);

  let isLoading = false;

  if (loading) {
    isLoading = true;
  }
  let pageInfo = null;
  let repositories = [];
  if (data) {
    isLoading = false;
    repositories = data.search.repos.map(repo => repo.repo);
    pageInfo = data.search.pageInfo;
  }

  const search = useRef("");
  const searchRepository = () => {
    getRepositories({
      variables: { name: search.current.value, after: null, before: null, first: 5}
    });
  }

  const prevPage = () => {
    getRepositories({
      variables: { name: search.current.value, after: null, before: pageInfo.startCursor, last: 5 }
    });
  }
  const nextPage = () => {
    getRepositories({
      variables: { name: search.current.value, after: pageInfo.endCursor, before: null, first: 5 }
    });
  }

  return (
    <div className="container">
      <main className={styles.main}>
        <h1 className={styles.title}>Search Repository</h1>

        <div className="row mt-5">
          <div className="col">
            <input ref={search} type="search" className="form-control" id="search" placeholder="Eg. Computer Vision" />
          </div>
          <div className="col-auto">
            <button onClick={searchRepository} type="button" className="btn btn-dark my-2 my-sm-0">Submit</button>  
          </div>
        </div>
        <div className="row mt-3">
          {isLoading && <div className="col-auto">
            <div className="spinner-border text-primary" role="status">
            </div>
          </div>}
        </div>
        {!isLoading && data && repositories.map(repo => (
          <div key={repo.id} className="card my-1" style={{width: '1000px'}}>
            <div className="card-body">
              <h5 className="card-title">{repo.nameWithOwner}</h5>
              <p className="card-text">{repo.description}</p>
              
              <a href={repo.url} className="btn btn-primary mx-1">Go to Repository URL</a>
              <Link href={'/repository/' + repo.id}><a className="btn btn-primary mx-1">Go to detail page</a></Link>
            </div>
          </div>
        ))}
        
        {/* Create pagination button */}
        {data && <nav aria-label="Page navigation example">
          <ul className="pagination justify-content-center">
            <li className="page-item">
              <button onClick={prevPage} className="btn btn-primary" aria-label="Previous" disabled={!pageInfo.hasPreviousPage}>
                <span className="sr-only">Previous</span>
              </button>
            </li>
            <li className="page-item">
              <button onClick={nextPage} className="btn btn-primary" aria-label="Next" disabled={!pageInfo.hasNextPage}>
                <span className="sr-only">Next</span>
              </button>
            </li>
          </ul>
        </nav>}

      </main>
    </div>
  );
}
