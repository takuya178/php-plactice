Rails.application.routes.draw do
  root to: 'static_pages#home'

  get 'login',  to: 'user_sessions#new'
  post 'login', to: 'user_sessions#create'
  delete 'logout', to: 'user_sessions#destroy'
  # get 'select', to: 'selects#index'


  resources :users, only: %i[new create show]
  resources :food_combinations, only: %i[new index] do
    collection do
      get 'select', to: 'food_combinations/select'
      get 'result', to: 'food_combinations#result'
    end
  end

  get 'food_combinations', to: 'food_combinations#index'

  namespace :admin do
    root 'dashboards#index'
    get 'login', to: 'user_sessions#new'
    post 'login', to: 'user_sessions#create'
    delete 'logout', to: 'user_sessions#destroy'
    resources :mains
  end

end
