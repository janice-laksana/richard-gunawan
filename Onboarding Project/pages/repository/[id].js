import Head from "next/head";
import Image from "next/image";
import Link from 'next/link'
import styles from "../../styles/Home.module.css";
import { useRouter } from 'next/router'

import {
  useMutation,
  useQuery,
} from "@apollo/client";
import { useEffect, useState } from "react";
import { STAR_REPO, UNSTAR_REPO } from "../../GraphQL/Mutations";
import { LOAD_REPOSITORIES, LOAD_REPOSITORIY } from "../../GraphQL/Queries";

const DetailRepository = () => {
  const [repository, setRepository] = useState()
  const router = useRouter()
  const { id } = router.query
  const { error, loading, data } = useQuery(LOAD_REPOSITORIY, {
    variables: {
      id: id,
    },
  });
  if (error) return `Error! ${error}`;
  const [starRepo, { errorStarRepo }] = useMutation(STAR_REPO);
  const [unstarRepo, { errorUnstarRepo }] = useMutation(UNSTAR_REPO);
  

  useEffect(() => {
    if (data) {
      const { node } = data;
      const repo = node;
      setRepository(repo);
    }
  }, [data]);

  const onStar = async (repo_id) => {
    starRepo({
      variables: {
        starrableId: String(repo_id),
      },
    });
    if (errorStarRepo) console.log(errorStarRepo);
  }

  const onUnstar = async (repo_id) => {
    unstarRepo({
      variables: {
        starrableId: String(repo_id),
      },
    });
    if (errorUnstarRepo) console.log(errorUnstarRepo);
  };

  return (
    <div className={styles.container}>

      <Head>
        <title>Richard Gunawan Onboarding Project</title>
        <meta name="description" content="GDP Labs Frontend Onboarding Project" />
        <link rel="icon" href="/favicon.ico" />
      </Head>

      <main className={styles.main}>
        <h1 className={styles.title}>
          Github Detail Page
        </h1>

        <h3>Repository</h3>
        <div className={styles.carddetail}>
          <button onClick={() => onStar(repository && repository.id)} className="btn btn-warning mx-1">Star</button>
          <button onClick={() => onUnstar(repository && repository.id)} className="btn btn-danger mx-1">Unstar</button>
          <a target={"_blank"} href={repository && repository.url} className="btn btn-success mx-1">Github Page</a>
          <h2>{repository && repository.nameWithOwner}</h2>
          
          <p>{repository && repository.description}</p>
          <p>🌟 {repository && repository.stargazerCount}</p>
          <p>Issues : {(repository && repository.issues.edges.length) ?? '-'}</p>
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

export default DetailRepository