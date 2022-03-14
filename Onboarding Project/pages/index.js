import Head from "next/head";
import Image from "next/image";
import styles from "../styles/Home.module.css";
import Link from 'next/link'

import {
  useMutation,
  useQuery,
} from "@apollo/client";
import { useEffect, useState } from "react";
import { LOAD_REPOSITORIES, LOAD_REPOSITORIY } from "../GraphQL/Queries";
import { STAR_REPO, UNSTAR_REPO } from "../GraphQL/Mutations";

export default function Home() {
  // Normal fetching
  const { error, loading, data, client } = useQuery(LOAD_REPOSITORIES);

  const [starRepo, { errorStarRepo }] = useMutation(STAR_REPO);
  const [unstarRepo, { errorUnstarRepo }] = useMutation(UNSTAR_REPO);
  const [repositories, setRepositories] = useState([]);
  
  useEffect(() => {
    if (data) {
      const { user } = data;
      const repositories = user.repositories.edges.map((edge) => edge.node);
      setRepositories(repositories);
    }
  }, [data]);

  const onStar = async (repo_id) => {
    starRepo({
      variables: {
        starrableId: String(repo_id),
      },
    });

    if (errorStarRepo) {
      console.log(errorStarRepo);
    }
  }

  const onUnstar = async (repo_id) => {
    unstarRepo({
      variables: {
        starrableId: String(repo_id),
      },
    });

    if (errorUnstarRepo) {
      console.log(errorUnstarRepo);
    }
  };

  return (
    <div className="container">
      <main className={styles.main}>
        <h1 className={styles.title}>
          Your Github Page
        </h1>

        <p className={styles.description}>
          Richard Gunawan {" "}<a target={"_blank"} href="https://github.com/richardgunawan26">🔗</a>
        </p>

        <h3>Your repositories</h3>
        <div className={styles.grid}>
          {repositories.map((repo) => {
            return (
              <div key={repo.id} className={styles.card}>
                <button onClick={() => onStar(repo.id)} className="btn btn-warning mx-1">Star</button>
                <button onClick={() => onUnstar(repo.id)} className="btn btn-danger mx-1">Unstar</button>
                <a target={"_blank"} href={repo.url} className="btn btn-success mx-1">Github Page</a>
                <h2>
                  <Link href={'/repository/' + repo.id}>
                    <a onMouseOver={() =>
                      client.query({
                        query: LOAD_REPOSITORIY,
                        variables: {
                          id: repo.id,
                        },
                      })
                    } >{repo.nameWithOwner}</a>
                  </Link>
                </h2>
                <p>{repo.description ?? "No Description"}</p>
                <p>🌟 {repo.stargazerCount}</p>
              </div>
            );
          })}
        </div>
      </main>

      <footer className={styles.footer}>
        <a
          href="https://vercel.com?utm_source=create-next-app&utm_medium=default-template&utm_campaign=create-next-app"
          target="_blank"
          rel="noopener noreferrer"
        >
          Powered by{" "}
          <span className={styles.logo}>
            <Image src="/vercel.svg" alt="Vercel Logo" width={72} height={16} />
          </span>
        </a>
      </footer>
    </div>
  );
}