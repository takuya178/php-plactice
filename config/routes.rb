Rails.application.routes.draw do
  root to: 'static_pages#home'

  get 'login',  to: 'user_sessions#new'
  post 'login', to: 'user_sessions#create'
  delete 'logout', to: 'user_sessions#destroy'
  post 'guest_login', to: 'user_sessions#guest_login'
  get 'privacy', to: 'static_pages#privacy'
  get 'terms', to: 'static_pages#terms'
  get 'explanation', to: 'static_pages#explanation'


  resources :users, only: %i[new create show]
  resources :food_combinations, only: %i[new index] do
    collection do
      get 'select', to: 'food_combinations/select'
      resources :mains
    end
  end

  get 'food_combinations', to: 'food_combinations#index'

  namespace :admin do
    root 'dashboards#index'
    get 'login', to: 'user_sessions#new'
    post 'login', to: 'user_sessions#create'
    delete 'logout', to: 'user_sessions#destroy'
    resources :mains
    resources :subs
    resources :food_combinations
  end

end
