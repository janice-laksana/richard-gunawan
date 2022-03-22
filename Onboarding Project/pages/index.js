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
import { STAR_REPO, SUBSCRIBE_REPO, UNSTAR_REPO, UNSUBSCRIBE_REPO } from "../GraphQL/Mutations";

import { ToastContainer, toast } from 'react-toastify';

export default function Home() {
  // Normal fetching
  const { error, loading, data, client } = useQuery(LOAD_REPOSITORIES);
  const [repositories, setRepositories] = useState([]);

  const onCompletedStar = (data) => {
    const payload = data.addStar.starrable;
    const repository = repositories.find(repo => repo.id === payload.id);

    const newStargazerCount = payload.stargazerCount;
    if(newStargazerCount === repository.stargazerCount) {
      toast.warning("Already starred", {autoClose: 2000})
    } else {
      toast.success("Starred", {autoClose: 2000})
    }
  }
  const onCompletedUnstar = (data) => {
    const payload = data.removeStar.starrable;
    const repository = repositories.find(repo => repo.id === payload.id);

    const newStargazerCount = payload.stargazerCount;
    if(newStargazerCount === repository.stargazerCount) {
      toast.warning("Already unstarred", {autoClose: 2000})
    } else {
      toast.success("Unstarred", {autoClose: 2000})
    }
  }

  const onCompleteSubscribe = (data) => {
    console.log('onCompleteSubscribe', data);
    toast.success("Subscribed", {autoClose: 2000})
  }

  const onCompleteUnsubscribe = (data) => {
    console.log('onCompleteUnsubscribe', data);
    toast.success("unsubscribed", {autoClose: 2000})
  }

  const [starRepo, { errorStarRepo }] = useMutation(STAR_REPO, {
    onCompleted: onCompletedStar,
  });
  const [unstarRepo, { errorUnstarRepo }] = useMutation(UNSTAR_REPO, {
    onCompleted: onCompletedUnstar,
  });
  const [subscribeRepo, { errorSubsribeRepo }] = useMutation(SUBSCRIBE_REPO, {
    onCompleted: onCompleteSubscribe,
  });
  const [unsubscribeRepo, { errorUnsubscribeRepo }] = useMutation(UNSUBSCRIBE_REPO, {
    onCompleted: onCompleteUnsubscribe,
  });
  
  useEffect(() => {
    if (data) {
      const { user } = data;
      const repositories = user.repositories.edges.map((edge) => edge.node);
      console.log('repositories', repositories);
      setRepositories(repositories);
    }
  }, [data]);

  const onStar = async (repo_id) => {
    const repository = repositories.find((repo) => repo.id === repo_id)
    starRepo({
      variables: {
        starrableId: String(repo_id),
      },
      optimisticResponse: {
        __typename: "Mutation",
        addStar: {
          __typename: "AddStarPayload",
          starrable: {
            __typename: "Repository",
            id: repo_id,
            stargazerCount: repository.stargazerCount + 1,
            viewerHasStarred: !(repository.viewerHasStarred)
          },
        },
      }
    });
  }

  const onUnstar = async (repo_id) => {
    const repository = repositories.find((repo) => repo.id === repo_id)
    unstarRepo({
      variables: {
        starrableId: String(repo_id),
      },
      optimisticResponse: {
        __typename: "Mutation",
        removeStar: {
          __typename: "RemoveStarPayload",
          starrable: {
            __typename: "Repository",
            id: repo_id,
            stargazerCount: repository.stargazerCount - 1,
            viewerHasStarred: !(repository.viewerHasStarred)
          },
        },
      }
    });
  };

  const onSubscribe = async (repo_id) => {
    const repository = repositories.find((repo) => repo.id === repo_id)
    subscribeRepo({
      variables: {
        subscribableId: String(repo_id),
      },
      optimisticResponse: {
        __typename: "Mutation",
        updateSubscription: {
          __typename: "UpdateSubscriptionPayload",
          subscribable: {
            __typename: "Repository",
            viewerSubscription: repository.viewerSubscription == 'SUBSCRIBED' ? 'UNSUBSCRIBED' : 'SUBSCRIBED',
          },
        },
      },
      update: (proxy, data) => {
        const newSubscription = data.data.updateSubscription.subscribable.viewerSubscription;
        
        let newRepo = repositories.find((repo) => repo.id === repo_id);
        let idx = repositories.findIndex((repo) => repo.id === repo_id);
        let objNewRepo = {...newRepo, viewerSubscription: newSubscription};
        let newRepositories = [...repositories];
        newRepositories[idx] = objNewRepo;
        setRepositories(newRepositories);
      }
    });
  }
  const onUnsubscribe = async (repo_id) => {
    const repository = repositories.find((repo) => repo.id === repo_id)
    unsubscribeRepo({
      variables: {
        subscribableId: String(repo_id),
      },
      optimisticResponse: {
        __typename: "Mutation",
        updateSubscription: {
          __typename: "UpdateSubscriptionPayload",
          subscribable: {
            __typename: "Repository",
            viewerSubscription: repository.viewerSubscription == 'UNSUBSCRIBED' ? 'SUBSCRIBED' : 'UNSUBSCRIBED',
          },
        },
      },
      update: (proxy, data) => {
        const newSubscription = data.data.updateSubscription.subscribable.viewerSubscription;
        
        let newRepo = repositories.find((repo) => repo.id === repo_id);
        let idx = repositories.findIndex((repo) => repo.id === repo_id);
        let objNewRepo = {...newRepo, viewerSubscription: newSubscription};
        let newRepositories = [...repositories];
        newRepositories[idx] = objNewRepo;
        setRepositories(newRepositories);
      }
    });
  }

  return (
    <div className="container">
      <main className={styles.main}>
        <h1 className={styles.title}>
          Your Github Page
        </h1>

        <p className={styles.description}>
          Richard Gunawan {" "}<a target={"_blank"} href="https://github.com/richardgunawan26">🔗</a>
        </p>

        <h3>Your Repositories</h3>

        {loading && (
          <div className="spinner-border" role="status">
          </div>
        )}
        {!loading && (
          <div className={styles.grid}>
            {repositories.map((repo) => {
              return (
                <div key={repo.id} className={styles.card}>
                  
                  {!repo.viewerHasStarred && <button onClick={() => onStar(repo.id)} className="btn btn-warning mx-1">Star</button>}
                  {repo.viewerHasStarred && <button onClick={() => onUnstar(repo.id)} className="btn btn-danger mx-1">Unstar</button>}

                  {repo.viewerSubscription == 'UNSUBSCRIBED' && <button onClick={() => onSubscribe(repo.id)} className="btn btn-primary mx-1">Subscribe</button>}
                  {repo.viewerSubscription == 'SUBSCRIBED' && <button onClick={() => onUnsubscribe(repo.id)} className="btn btn-secondary mx-1">Unsubscribe</button>}

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
                  <span className={'badge rounded-pill ' + (repo.viewerSubscription == 'SUBSCRIBED' ? 'bg-success' : 'bg-danger')}>{repo.viewerSubscription}</span>
                  <p>{repo.description ?? "No Description"}</p>
                  <p>🌟 {repo.stargazerCount}</p>
                </div>
              );
            })}
          </div>
        )}

      </main>
      <ToastContainer />
    </div>
  );
}