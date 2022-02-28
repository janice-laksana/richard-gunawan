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
  

  useEffect(() => {
    if (data) {
      const { node } = data;
      const repo = node;
      setRepository(repo);
    }
  }, [data]);

  return (
    <div>
      <h1>Name : {repository && repository.nameWithOwner}</h1>
      <h1>Description : {(repository && repository.description) ?? '-'}</h1>
      <h1>URL : {(repository && repository.url) ?? '-'}</h1>
      <h1>Issues : {(repository && repository.issues.edges.length) ?? '-'}</h1>
    </div>
  );
}

export default DetailRepository